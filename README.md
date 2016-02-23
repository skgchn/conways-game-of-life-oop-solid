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
$ php golcli.php   # Shows command usage<br>
$ php golcli.php -r 3 -c 3 -n 1<br>


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

<b>Yet to do</b><br>

1. Implement run() method in HTMLGameController and ConsoleGameController to remove much code from index.php and golcli.php<br>
2. Use a factory pattern to run both the web and console apps from same initial file gol.php, not requiring separate files for each, that is not requiring index.php or golcli.php<br>
3. Add HTML, header, body tags, etc. in HTMLGameRenderer...currently missing.<br>
4. Move js and css into separate javascript and css files respectively.<br>
5. May add GameAdvancer class, to allow variation in game of life rules without violating Open/Close principle.<br>
6. Reduce memory footstamp by passing around classnames of renderers, persistors, etc. and instantiating them only when using them<br>
7. Use gif images to show deaths and aging in each step. Survivors need to have grey hairs and not be jumping around.<br>
8. Implement a class or a method so as to not access superglobal $_GET directly.<br>
9. Unit tests!<br>
