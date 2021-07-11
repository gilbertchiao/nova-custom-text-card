<template>
    <card class="relative px-6 py-4 card-panel" :style="customCardStyle">
        <template v-if="! card.headingHtml">
            <div :class="headingClass" v-if="card.heading">
                <h3 class="mr-3 text-base text-80 font-bold">{{ card.heading }}</h3>
            </div>
        </template>
        <div v-else v-html="card.headingHtml"></div>

        <template v-if="! card.contentHtml">
            <div v-if="card.content" :class="contentClass">{{ card.content }}</div>
        </template>
        <div v-else v-html="card.contentHtml"></div>
    </card>
</template>

<script>
export default {
    props: ['card'],
    computed: {
        contentClass() {
            let className = 'flex text-90 font-light items-center'
            if (this.card.contentClass && typeof this.card.contentClass === 'string') {
                if (this.card.contentClass.substr(0, 1) === '!') {
                    className = this.card.contentClass.substr(1);
                } else {
                    className += ' ' + this.card.contentClass;
                }
            }
            return className;
        },
        customCardStyle() {
            let style = {}
            if (this.card.styleBackground) {
                style.background = this.card.styleBackground
            }
            if (this.card.styleBorder) {
                style.border = this.card.styleBorder
            }
            if (this.card.styleColor) {
                style.color = this.card.styleColor
            }
            if (this.card.styleHeight) {
                style.height = this.card.styleHeight
            }
            return style
        },
        headingClass() {
            let className = 'flex mb-4'
            if (this.card.headingAlign) {
                switch (this.card.headingAlign) {
                    case 'left':
                        className += ' justify-start'
                        break
                    case 'center':
                        className += ' justify-center'
                        break
                    case 'right':
                        className += ' justify-end'
                        break
                }
            }
            return className
        }
    },
    mounted() {
        if (this.card.forceFullWidth) {
            this.$parent.$el.classList.remove('w-5/6')
            this.$parent.$el.classList.add('w-full')
        }
    }
}
</script>
