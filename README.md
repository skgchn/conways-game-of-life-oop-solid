# Conway's Game of Life to demonstrate Object Oriented Programming (OOP) in PHP with S.O.L.I.D. principles in mind
S - Single Responsibility Principle - Build classes to do only one thing<br>
O - Open/Close Principle - Open for extension, but closed for modification<br>
L - Liskov's Substitution Principle - Specialized classes (sub-classes) can be used wherever generalized (parents) classes are being used<br>
I - Interface Segregation Principle - Classes be able to implement all methods in an interface<br>
D - Dependency Inversion Principle - Higher level classes should not directly use lower level classes. Lower level class should implement an interface. Higher level class should program to the interface, i.e. expect any object implementing an interface be given to it.<br>

<b>Setup instructions</b><br>

$ git clone https://github.com/skgchn/conways-game-of-life-oop-solid.git game-of-life<br>
$ cd game-of-life<br>
$ vagrant up<br>
Because of an error during vagrant up, I did these steps as well<br>
$ vagrant ssh<br>
$ sudo apt-get update<br>
$ exit<br>
$ rm puphpet/files/dot/ssh/id_rsa    # To be done for resolving error when running vagrant provision - SSH: * private_key_path` file must exist: C:\cygwin64\home\sunilg/.vagrant.d/insecure_private_key<br>
$ vagrant provision<br>

<b>Hosts file entry</b><br>
192.168.56.120 gameoflife.dev www.gameoflife.dev

<b>Running Conway's Game of Life from the command line</b><br>
$ vagrant ssh<br>
$ cd /var/www/gameoflife<br>
$ php golcli.php   # Shows last saved game state<br>
$ php golcli.php -n -r 3 -c 3     # Start a new game<br>
$ php golcli.php -a    # Advance game<br>


<b>Running from web</b><br>
Visit <b>gameofline.dev</b> or <b>www.gameoflife.dev</b> in your browser<br>

<b>OOP Design Progression</b><br>
1. Initial Thought<br>
![alt tag](https://github.com/skgchn/conways-game-of-life-oop-solid/blob/master/classdiagrams/1.%20InitialThought.jpg)<br><br>
2. After applying Single Responsiblity principle<br>
![alt tag](https://github.com/skgchn/conways-game-of-life-oop-solid/blob/master/classdiagrams/2.%20AfterApplyingSingleResponsiblityPrinciple.jpg)<br><br>
3. After adding the Game Controller<br>
![alt tag](https://github.com/skgchn/conways-game-of-life-oop-solid/blob/master/classdiagrams/3.%20AfterAddingTheGameController.jpg)<br><br>
4. After applying Open/Close and Dependency Inversion principles<br><br>
a) Controllers-Boards-Initializers<br>
![alt tag](https://github.com/skgchn/conways-game-of-life-oop-solid/blob/master/classdiagrams/4.%20OpenCloseDepencyInversionControllerBoardInitializersRelationship.jpeg)<br><br>
b) Controllers-Boards-Persisters<br>
![alt tag](https://github.com/skgchn/conways-game-of-life-oop-solid/blob/master/classdiagrams/5.%20OpenCloseDepencyInversionControllerBoardPersistersRelationship.jpeg)<br><br>
c) Controllers-Boards-Renderers<br>
![alt tag](https://github.com/skgchn/conways-game-of-life-oop-solid/blob/master/classdiagrams/6.%20OpenCloseDepencyInversionControllerBoardRenderersRelationship.jpg)<br><br>
5. With a little code refactoring (27/03/2016), I was able to take the game advancement logic out of the Board and GameController classes into its own class <b>LegacyGameAdvancer</b>, which implements the new <b>GameAdvancer</b> interface. This now makes it possible to modify the game's rules by writing a new class which implements GameAdvancer interface.<br><br>

<b>Yet to do</b><br>

1. Use a factory pattern to run both the web and console apps from same initial file index.php, not requiring separate files for each, that is not requiring both index.php and golcli.php<br>
2. Add HTML, header, body tags, etc. in HTMLGameRenderer...currently missing.<br>
3. Move js and css into separate javascript and css files respectively.<br>
4. In both Console and Web UI, add ability to specify board type and board initializer apart from the width and height when starting a new game.<br>
5. Reduce memory footprint by passing around classnames of renderers, persistors, etc. and instantiating them only when using them<br>
6. Use gif images to show deaths and aging in each step. Survivors need to have grey hairs and not be jumping around.<br>
7. Implement a class or a method so as to not access superglobal $_GET directly.<br>
8. Add unit tests!<br>
9. Implement MySQLBoardPersister<br>
10. Give user the ability to create the initial configuration.<br>
