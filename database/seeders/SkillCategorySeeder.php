<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\SkillSubcategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => "Java",
                'icon_class' => "fab fa-java",
                'subcategories' => [
                    [
                        'name' => "Version",
                        'skills' => [
                            [
                                'name' => "Java 8",
                                'description' => "Among the features introduced by Java 8, there are functional programming, streams and arrow functions.",
                                'picture_source' => asset('assets/img/logos/java/java.svg')
                            ]
                        ]
                    ],[
                        'name' => "GUI - Graphical User Interface",
                        'skills' => [
                            [
                                'name' => "Swing",
                                'description' => "Swing is a GUI widget toolkit for Java. It provides a look and feel that emulates the look and feel of several platforms. In addition to familiar components such as buttons, check boxes and labels, Swing provides several advanced components such as tabbed panel, scroll panes, trees, tables, and lists.",
                                'picture_source' => asset('assets/img/logos/java/swing.png')
                            ],[
                                'name' => "JavaFX",
                                'description' => "JavaFX is a software platform for creating and delivering desktop applications, as well as rich Internet applications (RIAs) that can run across a wide variety of devices. It is intended to replace Swing as the standard GUI library for Java SE.",
                                'picture_source' => asset('assets/img/logos/java/JavaFX_Logo.png')
                            ]
                        ]
                    ],[
                        'name' => "More",
                        'skills' => [
                            [
                                'name' => "Apache POI",
                                'description' => "Apache POI is a project that provides pure Java libraries for reading and writing files in Microsoft Office formats, such as Word, PowerPoint and Excel.",
                                'picture_source' => asset('assets/img/logos/java/Apache_POI_project_logo_(2018).svg')
                            ],[
                                'name' => "Apache Maven",
                                'description' => "Maven is a build automation tool used primarily for Java projects. It is more advanced than Apache Ant.",
                                'picture_source' => asset('assets/img/logos/java/Maven_logo.svg')
                            ],[
                                'name' => "Apache Ant",
                                'description' => "Apache Ant is a software tool for automating software build processes.",
                                'picture_source' => asset('assets/img/logos/java/Apache-Ant-logo.svg')
                            ]
                        ]
                    ]
                ]
            ],[
                'name' => "PHP",
                'icon_class' => "fab fa-php",
                'subcategories' => [
                    [
                        'name' => "Version",
                        'skills' => [
                            [
                                'name' => "PHP 5 (minimum)",
                                'description' => "PHP is one of the most used server-side scripting languages. The versions released after the 5th one introduce the support for the Object Oriented Programming paradigm. With PHP is possible to communicate with many DBMS (like MySQL and PosgreSql) and also NoSql databases (like MongoDB). PHP is optimized to work with MySql due to its APIs.",
                                'picture_source' => asset('assets/img/logos/php/PHP-logo.svg')
                            ]
                        ]
                    ],[
                        'name' => "Frameworks",
                        'skills' => [
                            [
                                'name' => "Laravel",
                                'description' => "Laravel is a free, open-source PHP web framework, intended for the rapid development of web applications following the model–view–controller (MVC) architectural pattern and based on Symfony. Laravel features a modular packaging system with a dedicated dependency manager, different ways for accessing databases, a powerful template engine (Blade) and several utilities that aid in application deployment and maintenance. Laravel also provides ready-to-use packages for a variety of uses: from subscription, coupons and invoices management with Cashier, to task management with Envoy, to OAuth with Socialite and Passport, to the scaffolding of the app itself.",
                                'picture_source' => asset('assets/img/logos/php/laravel.svg')
                            ],[
                                'name' => "CakePHP",
                                'description' => "Like Laravel, CakePHP is a PHP framework based on the MVC architectural patter.",
                                'picture_source' => asset('assets/img/logos/php/cakephp-logo.svg'),
                                'familiarity' => true
                            ]
                        ]
                    ],[
                        'name' => "Other tools",
                        'skills' => [
                            [
                                'name' => "Composer",
                                'description' => "Composer is a package manager for the PHP programming language that provides a standard format for managing dependencies of PHP software and required libraries. It runs from the command line and installs dependencies (e.g. libraries) for an application. It also allows users to install PHP applications that are available on Packagist, which is its main repository containing available packages.",
                                'picture_source' => asset('assets/img/logos/php/composer.svg')
                            ],
                        ]
                    ]
                ]
            ],[
                'name' => "Javascript",
                'icon_class' => "fab fa-js-square",
                'subcategories' => [
                    [
                        'name' => "Version",
                        'skills' => [
                            [
                                'name' => "EcmaScript 6",
                                'description' => "Up to the version of JS that implements the specifications of ECMAScript 6. The features introduced, among others, are: let/const, arrow functions, classes, modules, default parameters, collections and promises.",
                                'picture_source' => asset('assets/img/logos/javascript/ES6.svg')
                            ]
                        ]
                    ],[
                        'name' => "Front-end",
                        'skills' => [
                            [
                                'name' => "jQuery",
                                'description' => "jQuery is a library that focus on simplifying HTML DOM tree traversal and manipulation, as well as event handling, CSS animation. It also implements Ajax functionalities per the development of interactive web applications.",
                                'picture_source' => asset('assets/img/logos/javascript/jquery.svg')
                            ],[
                                'name' => "D3.js",
                                'description' => "D3.js is a library for producing dynamic, interactive data visualizations in web browsers. It makes use of the SVG, HTML5 and CSS standards.",
                                'picture_source' => asset('assets/img/logos/javascript/d3.svg')
                            ],[
                                'name' => "DataTables",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/javascript/datatables.png')
                            ],[
                                'name' => "React.js",
                                'description' => "React is a library for building composable user interfaces that encourages the creation of reusable UI components, which present data that changes over time. React abstracts away the DOM, offering a simpler programming model and better performance. React implements a one-way reactive data flow, which reduces the boilerplate and is easier to reason about than traditional data binding.",
                                'picture_source' => asset('assets/img/logos/javascript/react.svg'),
                                'familiarity' => true
                            ],[
                                'name' => "Redux",
                                'description' => "Redux is an open-source library for managing application state. The state held by the redux store becomes the only \"source of truth\" for the application, which can change through pre-defined actions. The result is a more predictable, debuggable and flexible application.",
                                'picture_source' => asset('assets/img/logos/javascript/redux.svg'),
                                'familiarity' => true
                            ]
                        ]
                    ],[
                        'name' => "Back-end",
                        'skills' => [
                            [
                                'name' => "Node.js",
                                'description' => "Node.js is a multiplatform, event-oriented runtime environment for the execution of JavaScript code. Node.js makes it possible to write JavaScript code to be used on the server-side, implementing the \"JavaScript everywhere\" paradigm, unifying the development of web applications around a single programming language. Node.js has an event-driven architecture capable of asynchronous I/O. These design choices aim to optimize throughput and scalability in web applications with many input/output operations, as well as for real-time Web applications.",
                                'picture_source' => asset('assets/img/logos/javascript/node.svg'),
                                'familiarity' => true
                            ]
                        ]
                    ],[
                        'name' => "More",
                        'skills' => [
                            [
                                'name' => "npm",
                                'description' => "Npm is a package manager for the JavaScript programming language and it is the default one for Node.js. It consists of a command line client, also called npm, and an online database of public and paid-for private packages, called the npm registry. Npm can manage packages that are local dependencies of a particular project, as well as globally-installed JavaScript tools. When used as a dependency manager for a local project, npm can install, in one command, all the dependencies of a project through the package.json file.",
                                'picture_source' => asset('assets/img/logos/javascript/npm.svg')
                            ],[
                                'name' => "Yarn",
                                'description' => "Yarn is a fast, reliable and secure dependency management that uses the npm registry. Yarn provides many performance and security improvements under the hood such as an offline cache for installed packages and deterministic installs (the yarn.lock file contains the exact version numbers of all your dependencies).",
                                'picture_source' => asset('assets/img/logos/javascript/yarn.svg')
                            ]
                        ]
                    ]
                ]
            ],[
                'name' => "HTML+CSS",
                'icon_class' => "fas fa-file-code",
                'subcategories' => [
                    [
                        'name' => "Version",
                        'skills' => [
                            [
                                'name' => "HTML5",
                                'description' => "HTML is the markup language to build the structure of web pages. HTML5 is the latest version of the language HTML, with added elements, attributes, behaviors, and a larger set of technologies that allows the building of more diverse and powerful Web sites and applications. HTML5 applications are characterized by better semantics (better accessibility for screen-readers, better and more form inputs, native audio and video support), performance, integration, connectivity (websockets for a permanent connection between the page and the server or the use of realtime communication), access to device features (camera, device orientation, geolocation, etc.), offline support, browser storage, 2/3D graphics and effects (canvas, svg, webGL).",
                                'picture_source' => asset('assets/img/logos/htmlCss/html5.svg')
                            ],[
                                'name' => "CSS3",
                                'description' => "CSS is a style sheet language used for describing the presentation of a document written in a markup language like HTML and it is designed to enable the separation of presentation and content. With CSS3, CSS has been extended to be able to style elements in a much more complex way, making it possible to have features like shadows on elements, multiple backgrounds, better border control, transitions and animations, better control on typography and advanced layout composition with grid and flexbox.",
                                'picture_source' => asset('assets/img/logos/htmlCss/css3.svg')
                            ]
                        ]
                    ],[
                        'name' => "Libraries",
                        'skills' => [
                            [
                                'name' => "Bootstrap",
                                'description' => "Bootstrap is a CSS framework directed at responsive, mobile-first front-end web development. It contains CSS- and JavaScript-based design templates for typography, forms, buttons, navigation and other interface components.",
                                'picture_source' => asset('assets/img/logos/htmlCss/bootstrap-4.svg')
                            ]
                        ]
                    ],[
                        'name' => "More",
                        'skills' => [
                            [
                                'name' => "Sass/Scss",
                                'description' => "SASS is an extention of the CSS language that makes it possible to use variables, to create functions and to organize the style sheet in several files. The Sass language is based on the concept of CSS preprocessor, which is used to define style sheets in a simpler, more complete and more powerful way compared to CSS. It is also used to generate optimized CSS files, putting together the structures that have been defined, even in a complex way.",
                                'picture_source' => asset('assets/img/logos/htmlCss/sass.svg')
                            ]
                        ]
                    ]
                ]
            ],[
                'name' => "Databases",
                'icon_class' => "fas fa-database",
                'subcategories' => [
                    [
                        'name' => "Relational DBs",
                        'skills' => [
                            [
                                'name' => "MySQL",
                                'description' => "MySQL is a RBMS (Relational Database Management System) that is supported by many programming languages (among which there are Java and PHP). It is included in platforms like LAMP, WAMP and XAMPP for the implementation of servers for developing dynamic websites. Many modern CMS like WordPress support MySQL by default.",
                                'picture_source' => asset('assets/img/logos/database/mysql.svg')
                            ],[
                                'name' => "PostgreSQL",
                                'description' => "PostgreSQL is a complete, highly programmable Object-Oriented DBMS that allows to build real-world applications using data taken from the database, due to an easier convertion of information from a relational schema to an object-oriented model (a problem that usually can take up to 40% of developing time). In PostgreSQL it's possible both to define new SQL types using the normal ones as a base and to use type inheritance (which is a fundamental aspect for Object Oriented programming).",
                                'picture_source' => asset('assets/img/logos/database/postgresql.svg')
                            ],[
                                'name' => "SQLite",
                                'description' => "SQLite is RDBMS contained in a C library that, in contrast to many other DBMS, is not a client-server database engine but is, instaed, embedded into the end program. SQLite implements most of the SQL standard. SQLite is a popular choice as embedded database for local/client storage in software applications. It is used today by several browsers, operating systems and embedded systems.",
                                'picture_source' => asset('assets/img/logos/database/sqlite.svg')
                            ],[
                                'name' => "Microsoft SQL Server",
                                'description' => "Microsoft SQL Server is a RDBMS produced by Microsoft that uses a variant of the standard SQL language, called T-SQL (Transact-SQL). I've worked briefly with SQL Server because it was the RDBMS used by the ERP application in one of my previous work places.",
                                'picture_source' => asset('assets/img/logos/database/microsoft-sql-server.svg'),
                                'familiarity' => true
                            ]
                        ]
                    ],[
                        'name' => "NoSQL DBs",
                        'skills' => [
                            [
                                'name' => "MongoDB",
                                'description' => "MongoDB is a non-relational, document-oriented DBMS. The documents are written in JSON format with a dynamic schema. It is one of the \"MERN\" stack components. MongoDB is an highly flexible, fast and reliable solution. It supports the use of ad hoc queries (with researches by fields, interval and regular expressions) as well as indexing for any kind of field (these indexes can be primary, secondary, geospatial, etc.). Moreover, with MongoDB it's possible to create replica sets as well as horizontally scale the application and balance the data load through sharding.",
                                'picture_source' => asset('assets/img/logos/database/mongodb.svg'),
                                'familiarity' => true
                            ]
                        ]
                    ],[
                        'name' => "Realtime DBs",
                        'skills' => [
                            [
                                'name' => "Google Firebase",
                                'description' => "Firebase is a mobile and web application development platform developed by Google. Among the various features, it provides a realtime database and backend as a service as well as an API that allows application data to be synchronized across clients and stored on Firebase's cloud. Google provides client libraries that enable integration with JavaScript, Java, Objective-C and Swift applications and the database is also accessible through a REST API and bindings for several JavaScript frameworks.",
                                'picture_source' => asset('assets/img/logos/database/google-firebase.svg'),
                                'familiarity' => true
                            ]
                        ]
                    ],
                ]
            ],[
                'name' => "Python",
                'icon_class' => "fab fa-python",
                'subcategories' => [
                    [
                        'name' => "Version",
                        'skills' => [
                            [
                                'name' => "Python 3",
                                'description' => "Python consistently ranks as one of the most popular programming languages. It is interpreted, dynamically-typed, high-level and general-purpose. Its design philosophy emphasizes code readability. It supports multiple programming paradigms, including procedural, object-oriented and functional programming.",
                                'picture_source' => asset('assets/img/logos/python/Python.svg')
                            ]
                        ]
                    ],[
                        'name' => "Frameworks",
                        'skills' => [
                            [
                                'name' => "Django",
                                'description' => "Django is a Python-based free and open-source web framework that follows the model–template–views (MTV) architectural pattern. Django's primary goal is to ease the creation of complex, database-driven websites. The framework emphasizes reusability and \"pluggability\" of components, less code, low coupling, rapid development, and the DRY principle. Django also provides an optional administrative CRUD interface that is generated dynamically through introspection and configured via admin models.",
                                'picture_source' => asset('assets/img/logos/python/django.svg'),
                                'familiarity' => true,
                            ]
                        ]
                    ],[
                        'name' => "Other tools",
                        'skills' => [
                            [
                                'name' => "Pandas",
                                'description' => "Pandas is a software library written for the Python programming language for data manipulation and analysis. In particular, it offers data structures and operations for manipulating numerical tables and time series.",
                                'picture_source' => asset('assets/img/logos/python/pandas.svg'),
                                'familiarity' => true,
                            ],
                        ]
                    ]
                ]
            ],[
                'name' => "More",
                'icon_class' => "fas fa-tools",
                'subcategories' => [
                    [
                        'name' => "IDE - Integrated Development Environment",
                        'skills' => [
                            [
                                'name' => "Visual Studio Code (current)",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/tools/vsc.svg'),
                            ],[
                                'name' => "Atom (past)",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/tools/atom.svg'),
                            ],[
                                'name' => "Android Studio (past)",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/tools/android_studio.svg'),
                            ],[
                                'name' => "Netbeans (past)",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/tools/netbeans.svg'),
                            ],[
                                'name' => "Eclipse (past)",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/tools/eclipse.svg'),
                            ],
                        ]
                    ],[
                        'name' => "Version Control System",
                        'skills' => [
                            [
                                'name' => "Git",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/tools/git.svg'),
                            ],
                        ]
                    ],[
                        'name' => "GIS - Geographic Information System",
                        'skills' => [
                            [
                                'name' => "OpenStreeMaps",
                                'description' => "OpenStreetMap is an open initiative to create and provide free geographic data such as street maps to anyone who wants them. Like Google Maps, but open source and everyone can collaborate to make it better.",
                                'picture_source' => asset('assets/img/logos/tools/Openstreetmap_logo.svg'),
                            ],
                        ]
                    ],[
                        'name' => "Programming methodologies",
                        'skills' => [
                            [
                                'name' => "Object Oriented Programming",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/tools/oop.svg'),
                            ],[
                                'name' => "Functional Programming",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/tools/functional.svg'),
                            ],[
                                'name' => "Parallel and Distributed Programming",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/tools/parallel.svg'),
                            ],[
                                'name' => "Event-driven Programming",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/tools/event.svg'),
                            ],[
                                'name' => "Use of Design Patterns (especially MVC)",
                                'description' => "",
                                'picture_source' => asset('assets/img/logos/tools/patterns.svg'),
                            ],
                        ],
                    ]
                    
                ]
            ]
        ];
        $order = 1;
        foreach ($categories as $categoryOrder => $category) {
            $tempCategory = new SkillCategory();
            $tempCategory->name = $category["name"];
            $tempCategory->order = $categoryOrder+1;
            $tempCategory->icon_class = isset($category["icon_class"]) ? $category["icon_class"] : null;
            $tempCategory->created_at = Carbon::now();
            $tempCategory->updated_at = Carbon::now();
            $tempCategory->save();
            if(isset($category["subcategories"])){
                foreach ($category["subcategories"] as $subcategoryOrder => $subcategory) {
                    $tempSubcategory = new SkillSubcategory();
                    $tempSubcategory->name = $subcategory["name"];
                    $tempSubcategory->order = $subcategoryOrder+1;
                    $tempCategory->subcategories()->save($tempSubcategory);
                    foreach ($subcategory["skills"] as $skillOrder => $skill) {
                        $tempSkill = new Skill();
                        $tempSkill->name = $skill["name"];
                        $tempSkill->order = $skillOrder+1;
                        if(isset($skill["description"]) && is_string($skill["description"])){
                            $tempSkill->description = $skill["description"];
                        }
                        if(isset($skill["picture_source"]) && is_string($skill["picture_source"])){
                            $tempSkill->picture_source = $skill["picture_source"];
                        }
                        if(isset($skill["familiarity"]) && is_bool($skill["familiarity"])){
                            $tempSkill->familiarity = $skill["familiarity"];
                        }
                        $tempSubcategory->skills()->save($tempSkill);
                    }
                }
            }
        }
    }
}
