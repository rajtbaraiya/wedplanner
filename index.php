<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wed Planner</title>
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--aos cdn link-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <link  rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"/>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <!--swiperjs cdn link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <!--custome css link-->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!--header section starts-->

    <header class="header">

        <a data-aos="zoom-in-left" data-aos-delay="150" href="#" class="logo"><i class= "fas fa-user"></i>FRENTE<br></a>

        <nav class="navbar">
            <a data-aos="zoom-in-left" data-aos-delay="300" href="#home">Home</a>
            <a data-aos="zoom-in-left" data-aos-delay="450" href="about.php">About Us</a>
            <a data-aos="zoom-in-left" data-aos-delay="600" href="service.php">Services</a>
            <a data-aos="zoom-in-left" data-aos-delay="750" href="destination.php">Destinations</a>
            <a data-aos="zoom-in-left" data-aos-delay="900" href="#contact">Review</a>
            <a data-aos="zoom-in-left" data-aos-delay="1050" href="photo.php">Photos</a>


            <a data-aos="zoom-in-left" data-aos-delay="1200" href="booking.php">Book Slot</a>
            
            <a data-aos="zoom-in-left" data-aos-delay="1200" href="faq.php">FAQs</a>
            <a data-aos="zoom-in-left" data-aos-delay="1200" href="theme_colors.php">Theme</a>

            <a data-aos="zoom-in-left" data-aos-delay="1350" href="/logg/register.php">Login</a>
            <a data-aos="zoom-in-left" data-aos-delay="1500" href="/logg/home.php">Profile</a>

        </nav>
        
        <div class="icons">
            <div data-aos="zoom-in-left" data-aos-delay="1350" class="fas fa-moon" id="theme-btn"></div>
            <div data-aos="zoom-in-left" data-aos-delay="1500" class="fas fa-bars" id="menu"></div>
        </div>



    </header>

    <!--header section ends-->

     <!--home section start-->

        <section class="home" id="home">

            <div class="content" data-aos="fade-down">
                <h3 style="font-family: boycott;">Your Wedding <br> Crafted in an Aesthetic Way<br></h3>

            </div>

           
        </section>

     <!--home section ends-->

     <!--text section-->
     <section class="text" id="text">

        <h1 class="heading">Planning A Dream Wedding?</h1>
        <div class="row">
            <div class="content" data-aos="fade" data-aos-delay="150">
                <p>We love visualizing the little many details that make your event exceptional . You can be rest assured that even the tiniest elements would be taken into consideration so you can enjoy your event as much as your guests.</p>
                <p>Whether we are planning a once-in-a-lifetime wedding, a Mehendi , a Haldi or a Party ,We plunge headlong into weaving a beaitiful tapestry of events that will linger in the minds of the families and guests alike. We look forward to getting to know you - and how we could help you plan your big day. </p>
                <h3 >Radhi,<br>Founder And Creative Head - FRENTE</h3>
            </div>
        </div>
    </section>




     <!--text section ends   style="text-align: right; font-size: medium;"-->

     <!-- about section starts

     <section class="about" id="about">

        <h1 class="heading">About Us</h1>
        <div class="row">
            <div class="content" data-aos="fade-up" data-aos-delay="150">
                <h3>Team Of Passionate People</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima dignissimos dicta totam, culpa, commodi nobis ratione ea adipisci asperiores iste cumque voluptas. Nobis enim reiciendis ratione, perspiciatis dolores quibusdam vitae.</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corrupti, rem a enim est sunt ipsam asperiores quae commodi maiores incidunt vel deserunt eveniet atque quo provident, quas eum illum neque!</p>
                <a href="#" class="btn">Read More</a>
            </div>
            <div class="image" data-aos="fade-down" data-aos-delay="300">
                <img src="images/chair.jpeg" alt=""></div>
        </div>
    </section>

 about section ends-->

    <!--service section starts

        <section class="services" id="services">

            <h1 class="heading">Our Services</h1>
            
            <div class="box-container">
                
                <div class="box" data-aos="zoom-in" data-aos-delay="150">
                    <img src="images/wed4.jpeg" alt="">
                    <h3>Full video and camera Services</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, cum. Magni porro eaque sed iste! Exercitationem dolore molestiae consequatur eligendi, consequuntur eaque obcaecati quidem, deleniti libero velit, officiis dolor delectus!</p>
                </div>

                <div class="box" data-aos="zoom-in" data-aos-delay="300">
                    <img src="images/wed5.jpeg" alt="">
                    <h3>We Arrange Flower and Decoration</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, cum. Magni porro eaque sed iste! Exercitationem dolore molestiae consequatur eligendi, consequuntur eaque obcaecati quidem, deleniti libero velit, officiis dolor delectus!</p>
                </div>

                <div class="box" data-aos="zoom-in" data-aos-delay="450">
                    <img src="images/wed6.jpeg" alt="">
                    <h3>Finding the right place for you</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, cum. Magni porro eaque sed iste! Exercitationem dolore molestiae consequatur eligendi, consequuntur eaque obcaecati quidem, deleniti libero velit, officiis dolor delectus!</p>

                
                </div>
            </div>

            
        </section>
    service section ends-->

    <!--pricing plan section starts-->
    
    <section class="plan" id="plan">
    <h1 class="heading" style="font-family:gabriola; font-size:5rem">Package Plan</h1>
    <div class="box-container">
        <div class="box" data-aos="zoom-in-up" data-aos-delay="150">
            <h3 class="title">Basic</h3>
            <h3 class="price">90000<span>₹</span></h3>
            <h3 class="month">Per Event</h3>
            <ul>
                <li><i class="fas fa-check"></i>Photography</li>
                <li><i class="fas fa-check"></i>Food</li>
                <li><i class="fas fa-check"></i>Pandits</li>
                <li><i class="fas fa-check"></i>Makeup Artists</li>
                <li><i class="fas fa-check"></i>Music And Party</li>
            </ul>
            <a href="booking.php?package=basic"><button class="btn">Go now</button></a>
        </div>

        <div class="box" data-aos="zoom-in-up" data-aos-delay="300">
            <h3 class="title">Standard</h3>
            <h3 class="price">200000<span>₹</span></h3>
            <h3 class="month">Per Event</h3>
            <ul>
            <li><i class="fas fa-check"></i>All From Basic Package</li>

                <li><i class="fas fa-check"></i>Decorators</li>
                <li><i class="fas fa-check"></i>Mehndi Artists</li>
                <li><i class="fas fa-check"></i>Anchors And Entertainment</li>



            </ul>
            <a href="booking.php?package=standard"><button class="btn">Go now</button></a>
        </div>

        <div class="box" data-aos="zoom-in-up" data-aos-delay="450">
            <h3 class="title">Premium</h3>
            <h3 class="price">400000<span>₹</span></h3>
            <h3 class="month">Per Event</h3>
            <ul>
            <li><i class="fas fa-check"></i>All From Standard Package</li>
                <li><i class="fas fa-check"></i>Dressing</li>
                <li><i class="fas fa-check"></i>Jewlery</li>
                <li><i class="fas fa-check"></i>Choreographer</li>
                <li><i class="fas fa-check"></i>Cake</li>
                

            </ul>
            <a href="booking.php?package=premium"><button class="btn">Go now</button></a>
        </div>
    </div>
</section>
    
    <!--pricing plan section ends-->



    <!--Wedding stories starts -->


    <section class="stories" id="stories">

        <h1 class="heading"><br>Wedding Stories Curted By FRENTE</h1>
        <div class="row">
            <div class="content" data-aos="fade" data-aos-delay="150">
                <h1>We- Implies The Beginning</h1>
                <p>We ensure that the work we render throughly represent you.
                    Our services range from themed wedding, <br>stage decor, Photography and much more.
                </p>
                <p>Creating memories across Kerala, Karnataka. So if you want to play a samll part in
                     creating that perfect beginning, do call us. We believe there is no better way to 
                     spend my life than to help others create celebrations that are memorable, personalized 
                     and extraordinary. You can be rest assures that even the tiniest elements would be taken
                      into consideration So that you can enjoy your event as much as your guests<br><br></p>
                
            </div>
            
        </div>
        <div >
            <img src="./images/logo_wed.jpg" alt="" >
           

        </div>
       
        
            
    </section>



    <!--promise section starts-->

        
    <section class="promise" id="promise">

        <h1 class="heading">Our Promise to you</h1>
        <div class="row">
            <div class="content" data-aos="fade" data-aos-delay="150">
                <h1>..Well Let's hear it from  the mother of our bride </h1>
                <p>
                    My daughter's wedding, as you can imagine, is the biggest 
                    event of our lives. We were so scared to trust anyone with
                    this responsibility and never thought anyone could do it better
                    than us. This was going to be difficult to organize because we 
                    had guests coming from all parts of the world, and soon realized
                    we needed help. After going through reviews of many planners
                    online, I came across one where a bride's father wrote glowing
                    reviews of Radhi. I was so curious to see who she was and what
                    she could do. From the moment we met Radhi, we knew                
                     this would work-the confidence they give you is immense. I have 
                    fallen in love with these angels! The wedding went without
                     a hitch. The decorations were out of this world! 
                </p>

                <p>
                    Every event from the Mehendi, Sangeet, Wedding to the 
                    amazing ball room reception at the Leela palace - was perfection.
                    They coordinated over a hundred foreigners and their different flights
                    and hotel check-ins. They handled everything from the venue, live 
                    bands, DJs, dance floors, all done without a frown, all around the 
                    clock. I can't thank you enough for making our dreams come true and 
                    for making my princess' fairytale wedding come to life. Thank you.
                </p>
            </div>
        </div>
    </section>





    <!--promise section ends-->

    <!--Wedding stories ends -->



     <!--galler section starts

        <section class="gallery" id="gallery">

            <h1 class="heading">Our Gallery</h1>

            <div class="swiper gallery-slider" data-aos="fade-up">

                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="images/haldi1.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/haldi2.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/haldi3.jpeg" />
                    </div>
                    
                    <div class="swiper-slide">
                        <img src="images/haldi4.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/haldi5.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/mehndi1.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/mehndi2.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/mehndi3.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/wed1.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/wed2.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/wed3.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/wed10.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/wed4.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/wed5.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/wed6.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/wed7.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/wed8.jpeg" />
                    </div>

                    <div class="swiper-slide">
                        <img src="images/wed9.jpeg" />
                    </div>
                 </div>

            </div>

        </section>

      gallery section ends-->



         <!-- reply section starts-->

     <section class="reply" id="reply">

        <h1 class="heading">Experiences With Wed Planner</h1>
        
        <div class="swiper review-slider" data-aos="zoom-in">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <div class="row">
                        <div class="content" data-aos="fade-up" data-aos-delay="150">
                            <h3>Himani & Nihal's Boho Adventure</h3>
                            <p>Have you heard of this ball of butterflies that few people can make you feel?
                                This couple is just so much of that. Nihal is a creative prodigy & for a change was 
                                shortlisting the color palettes etc, While Himani was the approval section making just 
                                the perfect choices for the day. Their duo gets you flabbergasted. And the outcome 
                                was a marvelous array of event, Colorful carnivals themed Sangeet, a Boho themed
                                afternoon and countless memories we carried along.<br>
                                perfect sindhi wedding. Just as fun it could get! All at our very own Bengluru!<br><br>
                                "Wish we could give more than 5 Stars!<br>
                                They are nothing short of amazing! Our wedding would not have been the fairy tale 
                                wonder it turned out to be without Wed-planner and their full efforts" </p>
                            <p style="color: mediumvioletred;">-Himani and Nihal</p>
                        </div>
                        <div class="image" data-aos="fade-down" data-aos-delay="300">
                            <img src="./images/boho adventure.jpeg" alt="">
                            <p style="color: mediumvioletred;">Venue:Fiesta resort, Bengluru</p>

                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="row">
                        <div class="content" data-aos="fade-up" data-aos-delay="150">
                            <h3>A Destination Wedding With Wed Planner</h3>
                            <p>
                                Destination Weddings be like this! A sunflower themed Mehendi,
                                A Hawaiian Themed sangeet, A mauve delight wedding and a classic
                                vintage reception all in the Queen of hills, Ooty. Still fresh are those
                                happy faces, the slight drizzle, fascinating hills around and agian the 
                                countless amusement. Our Bride lit up the world with her smile while our
                                groom with his voice, not kidding! They were meant to be and glad we could be a 
                                part in creating such a magnificent occasion.
                            </p>
                            <p>
                                "...they have left me speechless with their work and dedication and gave me the best decor,
                                planning at my wedding which I haven't seen at any other wedding. The decor had a 
                                personal touch to everything, every detail was taken care of and made to perfection."
                            </p>
                            <p style=" color: mediumvioletred;">-Sonali & Amit</p>

                        </div>
                        <div class="image" data-aos="fade-down" data-aos-delay="300">
                            <img src="./images/destination.jpeg" alt="">
                            <p style="color: mediumvioletred;">Venue:Hotel Gem Park, Ooty</p>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="row">
                        <div class="content" data-aos="fade-up" data-aos-delay="150">
                            <h3>Going by Traditions!</h3>
                            <p>
                                All the way from the United States, Our cutest bride Laya along with
                                her folks decided to have her wedding in their ancestral home in Kannur,
                                Kerala. Traditions followed like never before, from the way the bride dolled
                                herself up to her family counting on rituals, Omg! They made it seem all 
                                effortless in coping with the to-do's of the wedding prep and you know 
                                whta we are good at! We were a team and now they are more family!

                            </p>

                            <p>
                                "I didn't think our visions for the wedding were actually going to be
                                 accomplished until we talked with Radhi. She and her team delivered above 
                                 and beyond what our visions had hoped for."
                            </p>
                           <p style=" color: mediumvioletred;">-Laya & Ravi</p>
                        
                        </div>
                        <div class="image" data-aos="fade-down" data-aos-delay="300">
                            <img src="./images/byTradition.jpeg" alt="">
                            <p style="color: mediumvioletred;">Venue:Laya's ancestral home, Kannur</p>

                        </div>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <div class="row">
                        <div class="content" data-aos="fade-up" data-aos-delay="150">
                            <h3>A Dashing Reception!</h3>
                            <p>
                                There is a charm about few people that never is forgotten and you have a smile, each time you think of them. Niketh & Ashwathi are such people who have this fantastic vibe that made it all work like magic. They got into our "list of favorites" just the first time we spoke to Niketh. He was one of the very few clients who said,"Radhi, I leave it to you to come up with something for us, I trust in you!" And thosse words were enough to bring in "The Best Evening Ever", the miracle of candle panes, chandeliers, velvets, fairy lights and the remarkable beauty of many elements, so unique!
                            </p>
                            <p>"...They have done an excellent job for our Wedding reception. A hardworking team the whole team was brilliant! Our entrance way Wed Planner have done was outstanding! The stage decor, the pathway to stage elements, the dance floor designs, the lights everything was AMAZING! It was a Magical Evening!"</p>
                            <p style=" color: mediumvioletred;">-Niketh & Ashwathi</p>

                        </div>
                        <div class="image" data-aos="fade-down" data-aos-delay="300">
                            <img src="./images/reception.jpeg" alt="">
                            <p style="color: mediumvioletred;">Venue:Arabian Beach resort, Kannur</p>
                        </div>
                    </div>
                </div>

                
                <div class="swiper-slide slide">
                    <div class="row">
                        <div class="content" data-aos="fade-up" data-aos-delay="150">
                            <h3>The Charm of a Marwari Wedding!</h3>
                            <p>
                                This monsoon Wedding in Bengluru, is a stunning tale to reminisce. The gorgeous bride with her fabulous family and the groom, the royal kind from Jaipur. A Marwari wedding with some distinct events, made it so colorful and ethnic. It was a true blessing to see how minute details come together, with our hands of expertise in sprucing the venue and the family coordinating the rituals. The mandap which was curated for this wedding was featured by many, and that was the overwhelming appreciation we could ever ask for.
                            </p>
                            <p>
                                "...When I started planning for my wedding I literally had no idea about what my wedding should look like, but then I met Radhi from Wed Planner and they helped me with so many options and had always been there through all phases of idea, planning and execution."
                            </p>
                            <p style=" color: mediumvioletred;">-Sneha & Anirudh</p>

                        </div>
                        <div class="image" data-aos="fade-down" data-aos-delay="300">
                            <img src="./images/marwadi.jpeg" alt="">
                            <p style="color: mediumvioletred;">Venue:The Windflower Prakruti resorts & Spa, Bengluru</p>
                        </div>
                    </div>
                </div>

                
                <div class="swiper-slide slide">
                    <div class="row">
                        <div class="content" data-aos="fade-up" data-aos-delay="150">
                            <h3>When two states comes together!</h3>
                            <p>
                                Alisha with her cutest smile hails from the coolest mallu family we've seen. And our groom Akshay is well, from a Punjabi family(they don't need an into right?) the most happening people on the planet. Can you imaginethis blend? OMg! we had crazy fun curating this wedding.For the Mela themed Sangeet evening, Alisha had the one of it's kind "Bagpiper entry" while our Akshay was all bindaas on the tractor with an awesome band of dhol. Next day was the Mallu style wedding followed by the Punjabi style wedding, & they flashed it so cool. It was an elegant, kickass fun a love all over the air kind of wedding, at The Windflower Prakruthi resort & spa,Bengluru.
                            </p>
                            <p>
                                "Wed Planner is amazing!!!!they did such a fabulous job of the decor at my wedding people are still raving about them!! Every event the decor looked different and so tasteful and the best is they worked within budget and provided a personal touch to the experience"
                            </p>
                            <p style=" color: mediumvioletred;">-Alisha & Akshay</p>

                        </div>
                        <div class="image" data-aos="fade-down" data-aos-delay="300">
                            <img src="./images/two_state.jpeg" alt="">
                            <p style="color: mediumvioletred;">Venue:The Windflower Prakruti resorts & spa, Bengluru</p>
                        </div>
                    </div>
                </div>

                
                <div class="swiper-slide slide">
                    <div class="row">
                        <div class="content" data-aos="fade-up" data-aos-delay="150">
                            <h3>A ravishing Cherry Blossom Evening!</h3>
                            <p>
                                An Overwhelmingly beautiful evening, created for the super gorgeous Jitin & Arachana. It was an event so blossoming, more like an invite to the new beginning. Everything seemed so perfect that day, we were taken aback with all that complimented to the decor we curted. From the weather, to the music, to the lights, to the guest experience it was more than just what an expression could help with."An enchanted Cherry Blossom Evening", that you would love to know more about!
                            </p>
                            <p>
                                "...Radhi came down as an angel,he just knew how to make our likes and ideas into a much more beautiful reality!!! They looked into every detailing and made sure everything went well till the last minute like a member of the family, And that's what makes Wed Planner my favorite wedding planners..cause they do it like family and not just business I highly recommend Wed Planner for all my friends and family, Thanku Radhi(Wed planner)For all that you have done."
                            </p>
                            <p style=" color: mediumvioletred;">-Jitin & Archana</p>

                        </div>
                        <div class="image" data-aos="fade-down" data-aos-delay="300">
                            <img src="./images/evening.jpeg" alt="">
                            <p style="color: mediumvioletred;">Venue:Kanaka Beach Resort,Kannur</p>
                        </div>
                    </div>
                </div>

                
                <div class="swiper-slide slide">
                    <div class="row">
                        <div class="content" data-aos="fade-up" data-aos-delay="150">
                            <h3>At the Church, a day of Bliss!</h3>
                            <p>
                                We all know how Christian weddings go! It's all about the ceremony of vows and the exchange of rings, with the blessings of the almighty. Here, we added some elements to that bliss, a vintage decor! Usually churches don't permit decking up the place and this place was no exception. But why let go of options? We made the wonder happen at the entrance, passages and all the areas we could make it look a wedding. Come on! It's so boring without thoso props and fun hang outs. And guess what? The guests had an experience and a spot to dwell upon for pictures and a small caht. Vintage it was, classy at it's best!
                            </p>
                            <p>
                                Radhi did a great job. Stage designs and all decor was very good. Just have to trust him and he will take care of you.
                            </p>
                            <p style=" color: mediumvioletred;">-Jastin & Binsu</p>

                        </div>
                        <div class="image" data-aos="fade-down" data-aos-delay="300">
                            <img src="./images/church.jpeg" alt="">
                            <p style="color: mediumvioletred;">Venue:Kanaka Beach Resort, Kannur</p>
                        </div>
                    </div>
                </div>

                
                <div class="swiper-slide slide">
                    <div class="row">
                        <div class="content" data-aos="fade-up" data-aos-delay="150">
                            <h3>The Perfect Telugu Wedding, Soulful!</h3>
                            <p>
                                3 Sparkling days, had multiple events keeping us on toes. Families & friends from across the globe arrived and it was a celebration of our darling bride Sravani from Kenya and her groom Venkatesh from the United Stated. Days were full of life, colorful with traditions and rituals so elabrorate, they set a bench mark for sure! Tassels on mehndi,Tollywood Themed Sangeet, Balaji Nama with fresh roses for their wedding, we won't do justice with any words for the kind of wedding that we pulled out. Astonished Were the guests, So were the guests, so were the family themselves. From the first call in mind September to the planning  to curation, this Big Fat telugu Indian wedding was a match made in heaven, all in 80 days!
                            </p>
                            <p>
                                Radhi fashioned a wedding we had only dreamt of! We had about 80 days to put together a wedding with multiple events & rituals and i am beyond ecstatic to have accomplished it with Team Wed Planner.
                            </p>
                            <p style=" color: mediumvioletred;">-Sravani & Venkatesh</p>

                        </div>
                        <div class="image" data-aos="fade-down" data-aos-delay="300">
                            <img src="./images/telugu.jpeg" alt="">
                            <p style="color: mediumvioletred;">Venue:Signature Club Resorts, Bengluru</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="swiper-pagination">

            </div>
        </div>
    </section>

    

 <!--reply section ends-->





      <!--review section starts

        <section class="review" id="review">

            <h1 class="heading">Experiences With Wed Planner</h1>

            <div class="swiper review-slider" data-aos="zoom-in">

                <div class="swiper-wrapper">

                    <div class="swiper-slide slide">
                        <img src="images/wed3.jpeg" alt="">
                        <h3>Himani & Nihal's Boho Adventure</h3>
                        <p>Have you heard of this ball of butterflies that few people can make you feel?
                             This couple is just so much of that. Nihal is a creative prodigy & for a change was 
                             shortlisting the color palettes etc, While Himani was the approval section making just 
                             the perfect choices for the day. Their duo gets you flabbergasted. And the outcome 
                             was a marvelous array of event, Colorful carnivals themed Sangeet, a Boho themed
                             afternoon and countless memories we carried along.<br>
                             perfect sindhi wedding. Just as fun it could get! All at our very own Bengluru!<br><br>
                             "Wish we could give more than 5 Stars!<br>
                             They are nothing short of amazing! Our wedding would not have been the fairy tale wonder it turned out to be without Wed-planner and their full efforts" -Himani and Nihal

                             </p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <img src="images/wed4.jpeg" alt="">
                        <h3>John Deo</h3>
                        <p>"If you're planning an Indian wedding, look no further than Wed Planner! Their professionalism, creativity, and impeccable planning made our big day truly magical. We felt at ease throughout the entire process, and they ensured every detail was perfect. It was an experience we'll never forget!" - Sonali & Amit</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <img src="images/wed5.jpeg" alt="">
                        <h3>John Deo</h3>
                        <p>"The beachside view in Goa was the perfect backdrop for our destination wedding, and Wed Planner made sure every moment was picture-perfect. From the stunning venue to flawless event coordination, they took care of every detail. Goa’s natural beauty combined with their expert planning made it an unforgettable celebration." - Laya & Ravi</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <img src="images/wed6.jpeg" alt="">
                        <h3>John Deo</h3>
                        <P>"Our Kerala traditional wedding was an unforgettable experience, thanks to Wed Planner! The team took care of everything, from the thali tying ceremony to the eka shaanti pooja, with flawless coordination. Every aspect of our day was steeped in Kerala’s rich traditions, and Wed Planner made sure each moment was celebrated beautifully." - Pinal & Ravi</P>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <img src="images/wed5.jpeg" alt="">
                        <h3>John Deo</h3>
                        <p>"From the moment we started planning, we knew our wedding would be a mix of Punjabi and Gujarati traditions, but Wed Planner made it feel so effortless! The sangeet, mehendi, kalire, and garba were all perfectly executed, and we could just bask in the love and joy of the day. They took care of everything, and we couldn’t be more thankful for such a seamless experience. Our wedding felt like a true celebration of both our cultures, and it was everything we hoped for!" - Mantra & Preet</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <img src="images/wed5.jpeg" alt="">
                        <h3>John Deo</h3>
                        <p></p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                    <div class="swiper-slide slide">
                        <img src="images/wed5.jpeg" alt="">
                        <h3>John Deo</h3>
                        <p></p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                </div>

                <div class="swiper-pagination">

                </div>
            </div>
        </section>


      review section ends-->

      <!--team section starts-->

      <section class="team" id="team">

            <h1 class="heading" style="font-family:gabriola; font-size:5rem">Our Team</h1>

            <div class="box-container" data-aos="fade-up">

                <div class="box">
                    <img src="images/haldi1.jpeg" alt="">
                    <h3>Radhi Parmar</h3>
                    <p>Wedding Planner</p>
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>

                    </div>
                </div>


                <div class="box">
                    <img src="images/haldi2.jpeg" alt="">
                    <h3>Uday Parmar</h3>
                    <p>Wedding Manager</p>
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>

                    </div>
                </div>

                <div class="box">
                    <img src="images/haldi3.jpeg" alt="">
                    <h3>Khyati Shah</h3>
                    <p>Wedding Consultant</p>
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>

                    </div>
                </div>

                <div class="box">
                    <img src="images/haldi4.jpeg" alt="">
                    <h3>Mantra Shah</h3>
                    <p>Wedding Assistant</p>
                    <div class="share">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fab fa-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>

                    </div>
                </div>

            </div>

      </section>

      <!--team section ends-->

      <!--contact section starts-->

      <?php
// Start the session only if it hasn't been started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db_connection.php'; // Assuming this file contains your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_contact'])) {
    // Check if this form submission has already been processed
    if (!isset($_SESSION['form_submitted']) || $_SESSION['form_submitted'] !== true) {
        // Sanitize inputs
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $plan = filter_input(INPUT_POST, 'plan', FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

        // Basic server-side validation
        $errors = [];
        if (empty($name)) $errors[] = "Name is required.";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
        if (!preg_match("/^[0-9]{10}$/", $number)) $errors[] = "Enter a valid 10-digit phone number.";
        if (empty($date)) $errors[] = "Date is required.";
        if (empty($message)) $errors[] = "Message is required.";

        if (empty($errors)) {
            // Start a transaction to ensure both inserts succeed or fail together
            $conn->begin_transaction();

            try {
                // Insert into contact table
                $stmt_contact = $conn->prepare("INSERT INTO contact (name, email, number, date, address, plan, message, submitted_at) 
                                               VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
                $stmt_contact->bind_param("sssssss", $name, $email, $number, $date, $address, $plan, $message);
                $stmt_contact->execute();

                // Insert into review table
                $stmt_review = $conn->prepare("INSERT INTO review (name, email, number, date, address, plan, message, submitted_at) 
                                              VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
                $stmt_review->bind_param("sssssss", $name, $email, $number, $date, $address, $plan, $message);
                $stmt_review->execute();

                // If both queries succeed, commit the transaction
                $conn->commit();

                // Mark the form as submitted in the session
                $_SESSION['form_submitted'] = true;
                // Redirect to success.php
                echo '<script>window.location.replace("success.php");</script>';
                exit();
            } catch (Exception $e) {
                // If any query fails, rollback the transaction
                $conn->rollback();
                error_log("Database error: " . $e->getMessage());
                $errors[] = "Failed to send message. Please try again later.";
            }

            // Close statements
            $stmt_contact->close();
            $stmt_review->close();
        }
    } else {
        // If the form was already submitted, redirect to success.php
        echo '<script>window.location.replace("success.php");</script>';
        exit();
    }
}
?>

<section class="contact" id="contact">
    <h1 class="heading" style="font-family:gabriola; font-size:5rem">Give Review</h1>
    <form action="" method="POST" data-aos="zoom" id="contactForm">
        <?php
        // Display errors if any
        if (!empty($errors)) {
            echo '<script>alert("' . implode('\n', $errors) . '");</script>';
        }
        ?>
        <div class="inputBox">
            <input type="text" name="name" placeholder="Name" data-aos="fade-up">
            <input type="email" name="email" placeholder="Email" data-aos="fade-up">
        </div>
        <div class="inputBox">
            <input type="text" name="number" placeholder="Phone Number" data-aos="fade-up">
            <input type="date" name="date" data-aos="fade-up">
        </div>
        <div class="inputBox">
            <input type="text" name="address" placeholder="Your Address" data-aos="fade-up">
            <select name="plan" data-aos="fade-up">
                <option value="basic">Basic Plan</option>
                <option value="standard">Standard Plan</option>
                <option value="premium">Premium Plan</option>
            </select>
        </div>
        <textarea name="message" placeholder="Your Message" cols="30" rows="10"></textarea>
        <button type="submit" name="submit_contact" class="btn">Send Message</button>
    </form>
</section>

<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        let name = document.querySelector('input[name="name"]').value.trim();
        let email = document.querySelector('input[name="email"]').value.trim();
        let number = document.querySelector('input[name="number"]').value.trim();
        let date = document.querySelector('input[name="date"]').value;
        let message = document.querySelector('textarea[name="message"]').value.trim();

        let errors = [];

        if (!name) errors.push("Name is required.");
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) errors.push("Valid email is required.");
        if (!number || !/^[0-9]{10}$/.test(number)) errors.push("Enter a valid 10-digit phone number.");
        if (!date) errors.push("Date is required.");
        if (!message) errors.push("Message is required.");

        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join("\n"));
        }
    });
</script>
<!--contact section ends-->
      <!--contact section ends-->
      <!--Instagram section starts-->
      <section class="section_container instagram_container">
            <h2 class="section_header">~ INSTAGRAM ~</h2>
            <div class="instagram_flex">
              <img src="images/wed3.jpeg" alt="">
              <img src="images/haldi1.jpeg" alt="">
              <img src="images/haldi2.jpeg" alt="">
              <img src="images/haldi3.jpeg" alt="">
              <img src="images/haldi4.jpeg" alt="">
              <img src="images/haldi5.jpeg" alt="">
              <img src="images/invite1.jpeg" alt="">
              <img src="images/invite2.jpeg" alt="">
              <img src="images/invite3.jpeg" alt="">
              <img src="images/invite4.jpeg" alt="">
              <img src="images/invite5.jpeg" alt="">
              <img src="images/invite6.jpeg" alt="">
              <img src="images/invite7.jpeg" alt="">
              <img src="images/invite8.jpeg" alt="">
              <img src="images/invite9.jpeg" alt="">
              <img src="images/invite10.jpeg" alt="">
              <img src="images/invite11.jpeg" alt="">
              <img src="images/invite12.jpeg" alt="">
              <img src="images/invite13.jpeg" alt="">
              <img src="images/invite14.jpeg" alt="">
            </div>
          </section>

<script>
             
		  const instagram = document.querySelector(".instagram_flex");

Array.from(instagram.children).forEach((item) => {
const duplicateNode = item.cloneNode(true);
duplicateNode.setAttribute("aria-hidden", true);
instagram.appendChild(duplicateNode);
});

const instagram = document.querySelector(".instagram__flex");

Array.from(instagram.children).forEach((item) => {
  const duplicateNode = item.cloneNode(true);
  duplicateNode.setAttribute("aria-hidden", true);
  instagram.appendChild(duplicateNode);
});

 </script>

<style>
    .instagram_container
{
    overflow: hidden ;
}

.instagram_flex
{
    margin-top: 2rem;
    width: max-content;
    display: flex;
    align-items: center;
    gap: 1rem;


    animation: scroll 45s linear infinite;
}

.instagram_flex img
{
    max-width: 135px;
}

.swiper-pagin.swiper-pagination-bullet-active {
    background-color: var(--text-dark);
}

@keyframes scroll
{
    to
    {
        transform: translateX(calc(-50% - 0.5rem));
}
}
</style>



<!--Instagram Section Ends-->


      <!--Youtube section starts-->
      <section class="section_container youtube_container">
         <h2 class="section_header">~ YOUTUBE ~</h2>

          <style>

.section_container
{
    max-width: var(--max-width);
    margin: auto;
    padding: 5rem 1rem ;
}

.section_header
{
    margin-bottom: 1rem;
    font-size: 2rem;
    font-weight: 400;
    font-family: var(--header-font);
    color: var(--text-dark);
    text-align:center;
}
          /* Responsive container */
          .video-container {
              position: relative;
              width: 100%;
              max-width: 800px; /* Set maximum width */
              margin: 0 auto;   /* Center align */
              aspect-ratio: 16 / 9; /* Maintain 16:9 ratio */
          }

          .video-container iframe {
              position: absolute;
              top: 10;
              left: 0;
              width: 100%;
              height: 100%;
              border: 10; /* Remove border */
          }
      </style>
      <div class="video-container">
          <iframe 
              width="560" 
              height="315" 
              src="https://www.youtube.com/embed/UvUgtvgp8sc?si=z9b823UqeFdn1qI3" 
              title="YouTube video player" 
              frameborder="5" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
              allowfullscreen>
          </iframe>
          </div>
          </section>

          <style>
            		  .youtube_container
                        {
                             display: grid;
                        }
          </style>


            <!--Youtube section ends-->



      <!--footer section starts-->

            <section class="footer">

                <div class="box-container">

                    <div class="box" data-aos="fade-up">
                        <h3><i class="fas fa-user"></i>Us</h3>
                        <p>We plan your wedding in an asthetic and unique way which makes 
                            you feel nice and happy.We create themes and decor everythiny that makes
                            your special day even more special...
                        </p>
                        
                    </div>

                    <div class="box" data-aos="fade-up">
                        <h3>Our Services</h3>
                        <a href="#"><i class="fas fa-chevron-right"></i>Full Wedding Planning</a>
                        <a href="#"><i class="fas fa-chevron-right"></i>Full Wedding Arrangments</a>
                        <a href="#"><i class="fas fa-chevron-right"></i>Full Wedding Consultation</a>
                        <a href="#"><i class="fas fa-chevron-right"></i>Full Wedding Photoshoot</a>
                        <a href="#"><i class="fas fa-chevron-right"></i>Wedding Invitations Designs</a>


                    </div>

                    <div class="box" data-aos="fade-up">
                        <h3>Contact Us</h3>
                        <a href="#"> <i class="fas fa-phone"></i>+91 9428109499</a>
                        <a href="#"> <i class="fas fa-phone"></i>+91 9054328209</a>

                        <a href="#"><i class="fas fa-phone"></i>+91 8799366188</a>
                        <a href="#"><i class="fas fa-envelope"></i>info@Frentewedplanner.com</a>
                        <a href="#"><i class="fas fa-map"></i>Westport, op Sindhu Bhavan Road, Nr Taj Skyline, Off SP Road, Ahmedabad, Gujarat 380058</a>
                    </div>

                    <div class="box" data-aos="fade-up">
                        <h3>Follow Us</h3>
                        <a href="https://www.facebook.com/share/ww3vU3uHjANGmyYU/?mibextid=LQQJ4d"><i class="fab fa-facebook-f"></i> facebook</a>
                        <a href="https://www.instagram.com/udayfotografia?igsh=MWNpcXh6dTU1M3RvZg=="><i class="fab fa-instagram"></i> instagram</a>
                        <!--<a href="#"><i class="fab fa-twitter"></i> twitter</a>
                        <a href="#"><i class="fab fa-pinterest"></i> pinterest</a>-->

                    </div>

                </div>

                <div class="credit"> &copy; copyright @2024 by<span> FRENTE The Wed Planner</span></div>

            </section>


      <!--footer section ends-->






      <!--aos cdn link-->

      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

      <!--swiperjs cdn link-->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

        <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

     <!--custome js cdn link-->
    <script src="script.js"></script>
</body>
</html>