new Vue({
    el: "#slideshow",
    components: {
        Hooper: window.Hooper.Hooper,
        Slide: window.Hooper.Slide,
        HooperNavigation: window.Hooper.Navigation
    },
    data(){
        return {
            hooperSettings: {
                wheelControl: false,
                itemsToShow: 1.5,
                breakpoints: {
                    768: {
                        itemsToShow: 2.5
                    },
                    1024: {
                        itemsToShow: 3.5
                    }
                }
            }
        }
    }

  })