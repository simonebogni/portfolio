<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\PortfolioCategory;
use App\Models\PortfolioItem;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PortfolioItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portfolioItems = [
            [
                'title' => 'FaceDoor',
                'slug' => 'facedoor',
                'subtitle' => null,
                'description' => "Project at the first year of university.\r\nIt was requested to make the UI for a social network.\r\nIt doesn't provide a connection to the server but there are advanced features like: registration and login, profile search (with additional information provided to logged-in users) and profile editing/deletion.\r\nThe project uses advanced data-structure (like the red and black tree) to make the profile lookup faster.",
                'live_url' => null,
                'git_repo_url' => null,
                'cover_img_url' => null,
                'date' => Carbon::createFromDate(2015, 1, 15),
                'category_name' => 'java',
                'tags' => ['Java', 'Swing', 'Profile management', 'Data Structures'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'WatchNeighbors',
                'slug' => 'watchneighbors',
                'subtitle' => null,
                'description' => "Project at the second year of university.\r\nIt is an application to help neighborhood watch groups.\r\nUser that are not logged in can only see reported activities on the map, while logged in users can see and insert an activity in their neighborhood on the map, as well as mark themselves as taking charge of it.\r\nWhen a user registers to the platform, they receive an automated mail from the system, from which they have to click on a link in order to validate their profile.\r\nThe formal documentation was made in UML, the database used was PostgreSQL and OpenStreetMap was used for the map functionality. All the data is sanitized and preconfigured SQL statements were used to prevent SQL Injection attacks.\r\nThe Skeleton & Stub design pattern was used for the client-server interaction.",
                'live_url' => null,
                'git_repo_url' => null,
                'cover_img_url' => null,
                'date' => Carbon::createFromDate(2017, 6, 28),
                'category_name' => 'java',
                'git_repo_url' => 'https://github.com/simonebogni/WatchNeighbors',
                'tags' => ['Java', 'JavaFx', 'Geolocation', 'PostgreSQL', 'Mail', 'Profile management', 'UML', 'ERD', 'Distributed Programming', 'Sockets'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'Interactive CV and Portfolio',
                'slug' => 'interactivecv',
                'subtitle' => null,
                'description' => 'A responsive RESTful web application built with Laravel 8, SASS, Bootstrap and Blade template engine. The data is stored on a PostgreSQL database and the website is available on Heroku',
                'live_url' => env('APP_URL'),
                'git_repo_url' => 'https://github.com/simonebogni/simonebogni-laravel/',
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUWqC3ih7dLnmyK9421ReZh4JiDyfavRFAJTrCl_1HSaJddHTiNViHbLtX-Wkl-WggYBSAO1IFwJDDUY-56SgPB6AnbcZnLuWY5-k5G7GNXRt-Lk842KpwK2HS1QuDrt6ccjnsntRuArgJAbiXDwHI=w1341-h655-no?authuser=0'),
                'date' => Carbon::createFromDate(2021, 6, 1),
                'category_name' => 'webapps',
                'tags' => ['Recursion', 'PHP', 'Laravel', 'Bootstrap', 'SASS', 'HTML5', 'CSS3', 'JavaScript', 'jQuery', 'DataTables', 'PostgreSQL', 'RESTful API'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'ItalianPSQ',
                'slug' => 'italianpsq',
                'subtitle' => null,
                'description' => "A responsive web platform providing Pediatric Sleep Questionnaires to patients and allowing a faster contact with the pediatricians. It has been built as a proof of concept in collaboration with a student of a Medical Bachelor course. \r\n It uses the Laravel 8 framework, SASS and Bootstrap. The data is presented in a tabular form through the use of DataTables and it’s stored in a PostgreSQL database on Heroku. The application has been developed following the RESTful architectural stle.\r\nTo try the application you can use the following credentials:\r\n
                    Role: Patient | Username: a.manzoni@gmail.com | Password: 1234test\r\n
                    Role: Pediatrician | Username: m.rossi@italianpsq.com | Password: 1234test",
                'live_url' => 'http://italian-psq.herokuapp.com/',
                'git_repo_url' => 'https://github.com/simonebogni/italian-psq',
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUWSsidjfjEC38shwerJXpu7aBARfSCuhbajHnDnL8yVA3wo-ljE0JbCq9WtHsiWfFkeHBkHA-NNMAcU1vSuFdyZDWhPEmATb7PjWaNPQOfvKWbnMIUvj8_z_xlFyLNdYA6YxEJ1ruRc1NduTCi8HE=w1342-h655-no?authuser=0'),
                'date' => Carbon::createFromDate(2021, 6, 1),
                'category_name' => 'webapps',
                'tags' => ['PHP', 'Laravel', 'Bootstrap', 'SASS', 'HTML5', 'CSS3', 'JavaScript', 'jQuery', 'DataTables', 'PostgreSQL', 'RESTful API'],
                'images' => [
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLXtiTg0Kal4mtqiQ-gTUwCMty5rJ3ZZ3eNt6ne-QBKZsbXupwxQjPBlLg5l42_fKz7aVaIKkCFSIl8M5q5fYU1BMyycellF_uUQeRuGfp4G1ciufHOC-FRpDkefBB43AuXeVzUHFpKXt7LpSGHxt3g=w1010-h481-no?authuser=0'),
                        'name' => 'Login form for ItalianPSQ',
                        'alt' => 'Login form for ItalianPSQ'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUf1uOiGN-Aq4V6__9wKG_P_dr180nwGWEpiNezQaZ-oW3p-H3Nh4LgSlUmnL_qgxmMUeOChwWEssEVJ8s0o-9Fh7cxa7qGUXJOhcTBORAHNfiqcchYZFS245Y2ikIRg4zMmbikPzD5-FivMIY5UxQ=w1342-h640-no?authuser=0'),
                        'name' => 'Questionnaire form for an ItalianPSQ patient',
                        'alt' => 'Questionnaire form for an ItalianPSQ patient'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUbt3aDd4YWsE2oSHZ-VZbg2XMSFCm1v7YpZ7zC4zaWcpgV90Z2cBzvafCxboLBxeXB-yDeCVAE2XYn9dNHIokCM4DxQuuuFcyi2bP06yuUYTHZEnq_U2nUm4vm2JCxZsH6tk_rWKx8xaBiLew6m4s=w1360-h654-no?authuser=0'),
                        'name' => 'Questionnaire dashboard for an ItalianPSQ patient',
                        'alt' => 'Questionnaire dashboard for an ItalianPSQ patient'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLXMloFXQlp2i5vbWSO1dTEM4uBWA9g5REXj1aeTDck1ED-PsPPWlScN6BztWQghOdqTfqprUD6DvNqfvA22XaapDXHMQBulYoPPFPpvNm01QxQ7E2F28GKHFkZ1UAoL_XrKWD5UxFfX6fLughn9SoU=w1342-h652-no?authuser=0'),
                        'name' => 'User profile management for an ItalianPSQ patient',
                        'alt' => 'User profile management for ItalianPSQ patient'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUZcw29W17WxxBN5Ikl017hFMPWZDMC0PyYuGYVehPh98KvEaiPM2iwkVo1gcifdX6r3GjpZL7YX76I_p7Dbxsd3tH72kXgrKv2m6iKJI72_vz6knV6fw9_F9vpI74gkJMomOssst4-6KOfYcwv_Ps=w1344-h655-no?authuser=0'),
                        'name' => 'Questionnaire details - part 1',
                        'alt' => 'Questionnaire details - part 1'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUIoSfKdIZPtYX0s75Af0P2jqKn2Ka6lAeTnX1SgApXAwwZPXHB-BduN-YXtpZUReHr4oDkUP48ExSRRgqSXUtgT2dljb35pdHG3bMl-FSYlJ-7b9tNTi4jKmk91hcOMbOKYBum_dBZ1hd1RZUt6zM=w1345-h656-no?authuser=0'),
                        'name' => 'Questionnaire details - part 2',
                        'alt' => 'Questionnaire details - part 2'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLViKDRepdVDbtmFZgcs2STr6idktvuWpIGK9QlfnLHBJyOxYMFN1iPzb8mNWAFi4zbhUHq6Wd7RMDUQlctn4JJ4PodkpcCzinJ_24v2by9o0sVKr6_f-wqD-sDIEX8PdG1Nw0aHi2UdF3UCXNyRq-A=w1360-h656-no?authuser=0'),
                        'name' => 'Pediatrician dashboard showing the number of patients and of questionnairs, highlighting the new ones.',
                        'alt' => 'Pediatrician dashboard showing the number of patients and of questionnairs, highlighting the new ones.'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLXCjMIwD4Ns7Qsu-w4Yq1NRc81eS5csNDqZ8pGb-K3x5zEr5y9wR8QMTBE1TItS6MHRaujKBdq9gI6Iqv775fc0rvF-FFzg8KV85mXAXQXD7Yn-AOf06s7XJIQbsRKfpt0Q9hkBtZLkmwtQuL4eBUc=w1341-h655-no?authuser=0'),
                        'name' => 'Patient list from the Pediatrician control panel',
                        'alt' => 'Patient list from the Pediatrician control panel'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUxdcstnlagK2HCa163dwmPxi0rQvF2SZPN4VbY3gx4g1tHfBAJby95w-BAkqHFnfarmVPD2udeKlvEVkd1o_8X1JqdgMZFD38cKbt8y8W8ZRLn3xCuAkR0bgHujU79VYJ2y-f-1dbcyICfysKBkTI=w1360-h655-no?authuser=0'),
                        'name' => 'Patient questionnaires list from the Pediatrician control panel',
                        'alt' => 'Patient questionnaires list from the Pediatrician control panel'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLWm4knjLE3LGoTGzQVRpxtzO4wdZDw_2hTd56DtS0GiJCuClaZkN8HU5KpG2YTLUWQX5n1wKdcA8A4u0GS3RLlBvwRxzuL2HTIyn4ROEzwWoXFmZJMV2hj6tGC8F0GvZQBgEt3eVO33zG_j4VRtsps=w1342-h654-no?authuser=0'),
                        'name' => 'Patient account creation from the Pediatrician control panel',
                        'alt' => 'Patient account creation from the Pediatrician control panel'
                    ]
                    
                ]
            ],
            [
                'title' => 'CerealGreen',
                'slug' => 'cerealgreen',
                'subtitle' => null,
                'description' => "A web platform built as a Minimum Viable Product for the Hackathon hosted by the company SocialLibreria in 2019, built through the cooperation of 2 students from the Computer Science Bachelor course and 2 students from the Business and Economics Master course from University of Insubria (Varese, Italy). The platform has been built using the CakePHP framework and MySQL. It is an information system, used internally by a fictional multinational company to address the sale cycle across different departments. It was developed rapidly through prototypes over the course of 2 weeks. (More info in the Github repo)",
                'live_url' => null,
                'git_repo_url' => 'https://github.com/simonebogni/Hackathon-2019-Cereali',
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLWDNesMAEo6zquPAG5BuCNxEaLH5_sTTqFjyo76-Hjx3h2rwyA6MQvOCCy3Awy6Rh3ftap2JR-v_cIz-w_iJIa0dWOK-63NCb1v2f2erDWfa0DSITvWEvsOGcKQlZZC6BuFjsiwoa2lDIQi8uYz64w=w874-h489-no?authuser=0'),
                'date' => Carbon::createFromDate(2019, 11, 10),
                'category_name' => 'webapps',
                'tags' => ['PHP', 'CakePHP', 'Bootstrap', 'SASS', 'HTML5', 'CSS3', 'JavaScript', 'jQuery', 'DataTables', 'MySQL', 'RESTful API'],
                'images' => [
                ]
            ],
            [
                'title' => 'Mean-Variance-Standard Deviation Calculator',
                'slug' => 'da-python-mean-var-std-calc',
                'subtitle' => 'Freecodecamp certification project',
                'description' => "A function that uses Numpy to output the mean, variance, and standard deviation of the rows, columns, and elements in a 3 x 3 matrix.",
                'live_url' => 'https://replit.com/@simonebogni/boilerplate-mean-variance-standard-deviation-calculator-1',
                'git_repo_url' => null,
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLVMiIVRKApFkVcgzDh9Kl3nbmHLh6BLrj-AvEruJrM5-5yt9aUkP8LcmowFVie6IzbjP98dkcxCh6vMCdCeyCB7H7UXMjz7q4jqaP3foN5yXHovOcTrpSIi4GIfzDqy0vxwFGrxUOdN63exypbFbl6m=w623-h344-no?authuser=0'),
                'date' => Carbon::createFromDate(2021, 8, 3),
                'category_name' => 'data-analysis-python',
                'tags' => ['Python', 'Numpy'],
                'images' => [
                ]
            ],
            [
                'title' => 'Demographic Data Analyzer',
                'slug' => 'da-python-demographic-data-analyzer',
                'subtitle' => 'Freecodecamp certification project',
                'description' => "An analysis of a dataset of demographic data that was extracted from the 1994 Census database.",
                'live_url' => 'https://replit.com/@simonebogni/boilerplate-demographic-data-analyzer-1',
                'git_repo_url' => null,
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUIx4HUTlmI5pOkiUlcpIJcdS7vDQSLXav147LCxMIbLeOz35UlJyI2tKV8tNBWQuJmffBwGT1zJELez9eeRJGeCOZFm28oIz9nlFva8vrIcm3FjEsa6fzU0aIQML8-ptgQ1JVTTa8yNYbRZ5-Hen9C=w642-h347-no?authuser=0'),
                'date' => Carbon::createFromDate(2021, 8, 4),
                'category_name' => 'data-analysis-python',
                'tags' => ['Python', 'Numpy', 'Pandas'],
                'images' => [
                ]
            ],
            [
                'title' => 'Medical Data Visualizer',
                'slug' => 'da-python-medical-data-visualizer',
                'subtitle' => 'Freecodecamp certification project',
                'description' => "This project involves the visualisation and to make calculations from medical examination data using matplotlib, seaborn, and pandas.",
                'live_url' => 'https://replit.com/@simonebogni/boilerplate-medical-data-visualizer-1',
                'git_repo_url' => null,
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUrpZCQuIpgnfUFltV1Ff8f4Pu3OOcGJHz4n6AqjIaLd2JzOrnyTyAGOIusihwlCFWAKocofIJXBjAgMikRGA9FTMt3l-vrkHtNm6Le5S58qi1LN9AYByPMH3_fZkAn6Fi22ZYk-E7mrU8gr4egsVNy=w1058-h500-no?authuser=0'),
                'date' => Carbon::createFromDate(2021, 8, 6),
                'category_name' => 'data-analysis-python',
                'tags' => ['Python', 'Numpy', 'Pandas', 'Matplotlib', 'Seaborn'],
                'images' => [
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUrpZCQuIpgnfUFltV1Ff8f4Pu3OOcGJHz4n6AqjIaLd2JzOrnyTyAGOIusihwlCFWAKocofIJXBjAgMikRGA9FTMt3l-vrkHtNm6Le5S58qi1LN9AYByPMH3_fZkAn6Fi22ZYk-E7mrU8gr4egsVNy=w1058-h500-no?authuser=0'),
                        'name' => 'A chart showing the value counts of the categorical features, split by the presence or absence of cardiovascular disease',
                        'alt' => 'A chart showing the value counts of the categorical features (Physical activity, Alcohol intake, Cholesterol level, Glucose level, Overweight, Smoking), split by the presence or absence of cardiovascular disease.'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLWyMwg72tj7tEFcBHXEXYxInX6SeVCrE_5Rx-L2N7TMUNQ0Y_899zB-guxKEqUl1StsWdo4D3kx8wBjr3yPnuYr5qlybux8c4_7UjTsDM3Dr5W2Fxy3OwpYHdZRikNJtSGvfyotH5k71i1lb59WVTkS=s657-no?authuser=0'),
                        'name' => 'A heatmap showing the correlation matrix between the categorical features',
                        'alt' => 'A heatmap showing the correlation matrix between the categorical features'
                    ]
                ]
            ],
            [
                'title' => 'Page View Time Series Visualizer',
                'slug' => 'da-python-page-view-time-series-visualizer',
                'subtitle' => 'Freecodecamp certification project',
                'description' => "This project involves visualising a dataset read from a csv file, which contains the number of page views each day on the freeCodeCamp.org forum from 2016-05-09 to 2019-12-03. A line chart, a bar chart and box plots have been used in order to understand the patterns in visits and identify yearly and monthly growth. The outliers below the 2.5th and above the 97.5th quantile are removed to clean the data.",
                'live_url' => 'https://replit.com/@simonebogni/boilerplate-page-view-time-series-visualizer-2',
                'git_repo_url' => null,
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLU_-ypr_0iTb1fO0iO-Dq6HNoErgQv-_uoJN8U3hbrTRoQDqRFN6JlG1CJQn5sVnOOAir79p8-alyGbkV3LlHW9K7s9moQDp6_8eMy84gNBPYW9Mysg3a648IzYKZZB7IhZlZXmKJ7FaaJ395ZVxSls=w1200-h600-no?authuser=0'),
                'date' => Carbon::createFromDate(2021, 8, 8),
                'category_name' => 'data-analysis-python',
                'tags' => ['Python', 'Numpy', 'Pandas', 'Matplotlib', 'Seaborn'],
                'images' => [
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUGhRPUiEYXWQT52qMWBLGphRj2Pda70kFia3ykb4qyFDfSynQF8j3lpdc2QI8k3-SNa1wDhtAkYf3D2nrmcqhr21Q3ABmbauum49Kyg4t0XMWwyB9zQj4vB95qAyb65sBZxjwtEp8JLiRo5ZS3KMl8=w1200-h600-no?authuser=0'),
                        'name' => 'A line chart displaying the daily views of the FCC forum over the course of 4 years',
                        'alt' => 'A line chart displaying the daily views of the FCC forum over the course of 4 years'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLU73IEcM0pHLZSZOwAnHhB3ycz7fx0YaDNkfktdyvMRcvQ6ljk_6vHHYt9TLUtalEa1zE4YqWqanShdpnNohiG0KnD9Ms9qobS9AspmG3FPRdvujHwK8pacWzpgkee_71P_PT4t_NR2d-aCVW7GDrKf=s500-no?authuser=0'),
                        'name' => 'A bar chart showing the average daily page views for each month grouped by year',
                        'alt' => 'A bar chart showing the average daily page views for each month grouped by year'
                    ],
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLU_-ypr_0iTb1fO0iO-Dq6HNoErgQv-_uoJN8U3hbrTRoQDqRFN6JlG1CJQn5sVnOOAir79p8-alyGbkV3LlHW9K7s9moQDp6_8eMy84gNBPYW9Mysg3a648IzYKZZB7IhZlZXmKJ7FaaJ395ZVxSls=w1200-h600-no?authuser=0'),
                        'name' => 'Box plots with whiskers showing the trend (from 2016 to 2019) and the seasonality (per month) of the daily views of FCC forum pages',
                        'alt' => 'Box plots with whiskers showing the trend (from 2016 to 2019) and the seasonality (per month) of the daily views of FCC forum pages'
                    ]
                ]
            ],
            [
                'title' => 'Sea Level Predictor',
                'slug' => 'da-python-sea-level-predictor',
                'subtitle' => 'Freecodecamp certification project',
                'description' => "I analysed a dataset of the global average sea level change from 1880 to 2020 and visualised it through the use of a scatterplot. I've used the data to predict the sea level change up to the year 2050 with linear regression. The red line considers the data from 1880 to 2020, while the green one pictures a more updated (and grim) situation, considering only the data from 2000 to 2020.",
                'live_url' => 'https://replit.com/@simonebogni/boilerplate-sea-level-predictor-1',
                'git_repo_url' => null,
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLVDI_XrZfKwqPBpcCChEwotJ-c_Bu1KDXF7Qy8SPeBjjCGJprNcO7CZ5_YxyYO9dH9IcHclQhCSFc9Q_Xu6NzyiLWKqJ3iA5wCjX6OM8o5wT8zqvbTiIwsqs6FVjM4VBn6F2l29IRVmzn5PGWHY9up6=w640-h480-no?authuser=0'),
                'date' => Carbon::createFromDate(2021, 8, 9),
                'category_name' => 'data-analysis-python',
                'tags' => ['Python', 'Pandas', 'Matplotlib'],
                'images' => [
                    [
                        'url' => url('https://lh3.googleusercontent.com/pw/AM-JKLVDI_XrZfKwqPBpcCChEwotJ-c_Bu1KDXF7Qy8SPeBjjCGJprNcO7CZ5_YxyYO9dH9IcHclQhCSFc9Q_Xu6NzyiLWKqJ3iA5wCjX6OM8o5wT8zqvbTiIwsqs6FVjM4VBn6F2l29IRVmzn5PGWHY9up6=w640-h480-no?authuser=0'),
                        'name' => 'A scatterplot showing the correlation between the years and the level of the sea in inches. Through linear regression, we can find the expected level in 2050 (~10 considering the trend from 1880, or ~15.5 considering only the last 20 years)',
                        'alt' => 'A scatterplot showing the correlation between the years and the level of the sea in inches. Through linear regression, we can find the expected level in 2050 (~10 considering the trend from 1880, or ~15.5 considering only the last 20 years)'
                    ]
                ]
            ],
            [
                'title' => 'Treemap',
                'slug' => 'd3js-treemap',
                'subtitle' => 'Kickstarter pledges',
                'description' => null,
                'live_url' => 'https://codepen.io/simonebogni/full/KKKdrmq',
                'git_repo_url' => null,
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLUU78zI0XIw9WyUKVYpwCibnIfpLMx2JQSebvEDXkJpdtUM7PU1arzlYTKGypuDUEKOy38GxFJjp_8x_9uBjBSz1_AI4gNX3sQETMP30KbzkpfFIcu-uS1-tA3-Bg5e4Xt97GAQKDlOPwZOHLVItHk=w640-h360-no?authuser=0'),
                'date' => Carbon::createFromDate(2019, 10, 11),
                'category_name' => 'd3js',
                'tags' => ['JavaScript', 'D3.js'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'Choropleth Map',
                'slug' => 'd3js-choropleth',
                'subtitle' => 'US Education Attainment',
                'description' => null,
                'live_url' => 'https://codepen.io/simonebogni/full/yLLYQoP',
                'git_repo_url' => null,
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLXSPRMAYefYLebVWo3ZvX8cdNM0WxGTB9R7QSWoLfC3TzqF7ULwRivqPwLjNM8mRxVS3uvBHxPSb64jiSnYvGdX2tThjqKilxZ2YjgOMqV1k6ZeZN9-2baAMsB2OwRporz9mYpTFQRWWT7mnre5URo=w640-h360-no?authuser=0'),
                'date' => Carbon::createFromDate(2019, 10, 11),
                'category_name' => 'd3js',
                'tags' => ['JavaScript', 'D3.js'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'Heatmap',
                'slug' => 'd3js-heatmap',
                'subtitle' => 'Monthly global land-surface temperature',
                'description' => null,
                'live_url' => 'https://codepen.io/simonebogni/full/poojQWW',
                'git_repo_url' => null,
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLXl23BiujVs_i9X-fldxqaN9ocuk7nnj9DkVijnvKipIWfWMV4ploGaYyn0lQVPs6rgmDjVPjasd0Br3ELh4gmufyUtWEQgW04lzX18D_Ibp5a3ZlR6yveP9FFp604ekD-G3vbJWckJVF0JQqpeKWo=w640-h360-no?authuser=0'),
                'date' => Carbon::createFromDate(2019, 10, 11),
                'category_name' => 'd3js',
                'tags' => ['JavaScript', 'D3.js'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'Scatterplot chart',
                'slug' => 'd3js-scatterplot',
                'subtitle' => 'Doping in professional bycicle racing',
                'description' => null,
                'live_url' => 'https://codepen.io/simonebogni/full/BaavXmo',
                'git_repo_url' => null,
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLWObEOnN-r_RuqEUA9_eBU8xdFO5HOWp6AoaFm_U6EjQdPRpnMwM_7tc13GJSwhQTNyD2FAYYCrzhAZsq3OLtlusR6BMvNvrVoxGJz641ERVkzGLhgEPQKDx4U_48yZgd5mwiYVrzYGDtvquOa2Ou4=w640-h360-no?authuser=0'),
                'date' => Carbon::createFromDate(2019, 11, 19),
                'category_name' => 'd3js',
                'tags' => ['JavaScript', 'D3.js'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
            [
                'title' => 'Bar chart',
                'slug' => 'd3js-bar',
                'subtitle' => 'Gross Domestic Product',
                'description' => null,
                'live_url' => 'https://codepen.io/simonebogni/full/XWWovwP',
                'git_repo_url' => null,
                'cover_img_url' => url('https://lh3.googleusercontent.com/pw/AM-JKLVcvZzyp9dKuQ66WSFP_-pbjS6f_w-G9hiUX_KRiF59ysacKrftQVBEkjFwWgCJ0om5HvSpgnqaQv7tcth_Ht-56X9lG_hrIJ_WmQ5nwGG4QXS1pbkvpSmwTqy_Y2NDRdfUMvbRCLV3ljISOSm3diE=w640-h360-no?authuser=0'),
                'date' => Carbon::createFromDate(2019, 11, 19),
                'category_name' => 'd3js',
                'tags' => ['JavaScript', 'D3.js'],
                'images' => [
                    /*[
                        'url' => '',
                        'name' => '',
                        'alt' => ''
                    ]*/
                ]
            ],
        ];
        foreach($portfolioItems as $item){
            $pi = new PortfolioItem();
            $pi->title = $item['title'];
            if($item['slug'] != null){
                $pi->slug = $item['slug'];
            }
            if($item['subtitle'] != null){
                $pi->subtitle = $item['subtitle'];
            }
            if($item['description'] != null){
                $pi->description = $item['description'];
            }
            if($item['live_url'] != null){
                $pi->live_url = $item['live_url'];
            }
            if($item['git_repo_url'] != null){
                $pi->git_repo_url = $item['git_repo_url'];
            }
            if($item['cover_img_url'] != null){
                $pi->cover_img_url = $item['cover_img_url'];
            }
            if($item['date'] != null){
                $pi->date = $item['date'];
            }
            $category = null;
            if($item['category_name'] != null){
                $category = PortfolioCategory::firstWhere('name', $item['category_name']);
            } else {
                $category = PortfolioCategory::firstWhere('name', '_other');
            }
            $pi->portfolio_category_id = $category->id;
            $pi->save();
            foreach($item["tags"] as $tag){
                $tag = Tag::firstWhere('name', $tag);
                if(isset($tag)){
                    $pi->tags()->attach($tag);
                }
            }
            foreach($item["images"] as $image){
                $im = new Image();
                $im->url = $image['url'];
                $im->name = $image['name'];
                $im->alt = $image['alt'];
                $im->save();
                $pi->images()->attach($im);
            }
            $pi->save();

        }
    }
}
