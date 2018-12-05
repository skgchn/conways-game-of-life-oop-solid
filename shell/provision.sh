# -- Static IP Address -- #
staticipaddr="192.168.56.120"

# ---- Apache Config ---- #
siteconf="001-yoursitename"
site="/etc/apache2/sites-available/$siteconf.conf"
sitelogloc="/var/log/apache2"
servername="gameoflife.test"
serveralias="www.$servername"
documentroot="/var/www/gameoflife"

# ---- MySQL Config ----- #
# Uncomment this to assign user name and password in mysql
dbusername="cgol"
dbuserpass="1235"
dbrootpass="1235"
dbname="cgol"
dbcharset="utf8mb4"
dbcollate="utf8mb4_general_ci;"

# Uncomment this if you want vagrant provision to automatically import database. Before provisioning make sure to take database dump after making changes in the website or webapp because you will loose changes made to the database.
# dbdumpfile="/path/to/database/file.sql" 

cat <<EOF

This is a vagrant machine created by Karun Girdhar (karungirdhar.in) for Conways Game of Life OOP Solid

EOF

echo ""
echo "Running apt-get update..."
echo ""
apt-get update

echo ""
echo "Running apt-get upgrade..."
echo ""
apt-get -y upgrade

echo ""
echo "Installing Apache2..."
echo ""
apt-get install -y \
    apache2

echo ""
echo "Installing PHP and PHP Modules..."
echo ""
apt-get install -y \
    libapache2-mod-php \
    php \
	php-intl \
	php-gd \
	php-cli \
	php-xml

echo ""
echo "Installing MySQL..."
echo ""
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $rootdbpass"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $rootdbpass"
apt-get -y install \
	mysql-client \
	mysql-server \
    php-mysql \
    

echo ""
echo "Configuring Apache..."
echo ""
echo $site

echo ""
echo "Adding site $servername..."
echo ""
touch $site
cat << EOF > $site
<VirtualHost *:80>
	# The ServerName directive sets the request scheme, hostname and port that
	# the server uses to identify itself. This is used when creating
	# redirection URLs. In the context of virtual hosts, the ServerName
	# specifies what hostname must appear in the request's Host: header to
	# match this virtual host. For the default virtual host (this file) this
	# value is not decisive as it is used as a last resort host regardless.
	# However, you must set it for any further virtual host explicitly.
	ServerName $servername
	ServerAlias $serveralias

	ServerAdmin webmaster@localhost
	DocumentRoot $documentroot

  	<Directory "$documentroot">
  	  Options Indexes FollowSymlinks MultiViews
  	  AllowOverride All
  	  Require all granted
  	  DirectoryIndex index.php index.html
  	</Directory>

	# Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
	# error, crit, alert, emerg.
	# It is also possible to configure the loglevel for particular
	# modules, e.g.
	#LogLevel info ssl:warn

	ErrorLog $sitelogloc/error.log
	CustomLog $sitelogloc/access.log combined

	# For most configuration files from conf-available/, which are
	# enabled or disabled at a global level, it is possible to
	# include a line for only one particular virtual host. For example the
	# following line enables the CGI configuration for this host only
	# after it has been globally disabled with "a2disconf".
	# Include conf-available/serve-cgi-bin.conf
</VirtualHost>
EOF

echo ""
echo "Enabling site $servername..."
echo ""
a2ensite $siteconf

echo ""
echo "Enabling Apache mod rewrite"
echo ""
a2enmod rewrite

echo ""
echo "Starting MySQL..."
echo ""
systemctl start mysql

# Uncomment to create a MySQL user
echo ""
echo "Creating User $dbusername"
echo ""
mysql -u root -p$dbrootpass -e "CREATE USER '$dbusername'@'localhost' IDENTIFIED BY '$dbuserpass';"

echo ""
echo "Creating Database..."
echo ""
mysql -u root -p$dbrootpass -e "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET $dbcharset COLLATE $dbcollate;"
echo ""
echo "Database Created..."
echo ""
echo "Database Info: "
echo "Database Name: $dbname"
echo "Database Charset: $dbcharset"
echo "Database Collate: $dbcollate"

# Uncomment this if you want vagrant provision to automatically import database. Before provisioning make sure to take database dump after making changes in the website or webapp because you will loose changes made to the database.
# echo ""
# echo "Importing Database Dump from $dbdumpfile to $dbname..."
# echo ""
# mysql -u root -p$dbrootpass $dbname < $dbdumpfile

# Uncomment this if you are granting priveleges of mysql database to dbuser
echo ""
echo "Granting all priveleges for $dbname to $dbusername"
echo ""
mysql -u root -p$dbrootpass -e "GRANT ALL ON $dbname.* TO '$dbusername'@'localhost' IDENTIFIED BY '$dbuserpass';"

echo ""
echo "Reloading Apache2..."
echo ""
systemctl reload apache2

echo ""
echo "Installing git..."
echo ""
apt-get install -y \
    git

echo ""
cat <<EOF

You will need to add a hosts file entry for:
$servername $serveralias points to $staticipaddr
    
EOF
