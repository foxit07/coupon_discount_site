
        $(document).ready(function() {
            $('.autoplay').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            arrows: true,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 2
                        }
                    },

                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 3
                        }
                    },

                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 1
                        }
                    },


                    {
                        breakpoint: 737,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '110px',
                            slidesToShow: 1
                        }
                    },

                    {
                        breakpoint: 321,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '15px',
                            slidesToShow: 1
                        }
                    },
                ]
            });

        });



        $(document).ready(function() {
            $("#drop a").click(function() {
                var ico = $(this).find('i')
                if (ico.hasClass("fa fa-angle-up")) {
                    $(ico).removeClass().addClass("fa fa-angle-down")
                } else {
                    $(ico).removeClass().addClass("fa fa-angle-up")
                }
            })
        });


        /*  $(document).ready(function() {
          // $("#details2,#details1,#details3").click(function() {
          $('[id^="details"]').click(function() {
              var ico = $(this).find('i')
              if (ico.hasClass("fa fa-angle-up")) {
                  $(ico).removeClass().addClass("fa fa-angle-down")
              } else {
                  $(ico).removeClass().addClass("fa fa-angle-up")
              }

          })
          });*/
