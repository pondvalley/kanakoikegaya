new Vue({
    el: '#navigation',
    data: {
            showMenu: false,
            showNavbar: true,
            lasScrollPosition: 0,
            scrollValue: 0
    },

    mounted() {
        this.lastScrollPosition = window.pageYOffset
        window.addEventListener('scroll', this.onScroll)
    },

    beforeDestroy() {
        window.removeEventListener('scroll', this.onScroll)
    },

    methods: {

        onScroll() {
            if (window.pageYOffset < 0) {
                return
            }
            if (Math.abs(window.pageYOffset - this.lastScrollPosition) < 100) {
                return
            }
            if (this.showMenu == true) {
                return
            }
            this.showNavbar = window.pageYOffset < this.lastScrollPosition
            this.lastScrollPosition = window.pageYOffset
        },
        toggleMenu() {
        this.showMenu = !this.showMenu
    }
}
})

