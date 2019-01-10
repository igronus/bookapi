<template>
    <div>
        <form v-on:submit.prevent="clear_and_search">
            <input type="text" placeholder="Search here, e.g. 'Gianni Rodari'" v-model="search_string">
            <input type="submit" value="Search">
        </form>

        <div v-if="this.$store.state.fired" class="row">
            <div v-for="item in this.$store.state.items" class="col-lg-3 spaced">
                <div class="card">
                    <img v-if="item.volumeInfo.imageLinks" :src="item.volumeInfo.imageLinks.thumbnail" class="card-img-top" :alt="item.id">
                    <h2>{{ item.volumeInfo.title }}</h2>
                    <i>{{ item.volumeInfo.authors }}</i><br>
                    Published on {{ item.volumeInfo.publishedDate }}<br>
                    by {{ item.volumeInfo.publisher }}

                    <a v-if="item.saleInfo && item.saleInfo.buyLink" :href="item.saleInfo.buyLink" target="_blank">
                        <b>BUY NOW</b>
                    </a>
                </div>
            </div>
        </div>

        <div v-if="this.$store.state.fired">
            <button @click="search" v-if="this.$store.state.items.length < this.$store.state.total">
                Load more
            </button>

            {{ this.$store.state.items.length }}/{{ this.$store.state.total }} (page {{ this.$store.state.page }})
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return  {
                search_string: ''
            }
        },

        mounted() {
            console.log('Component mounted.');

            this.$store.commit('clear');
        },
        methods: {
            clear_and_search() {
                this.$store.commit('clear');
                this.search();
            },
            search() {
                axios.get('/search?search=' + this.search_string + '&page=' + this.$store.state.page)
                    .then(response => {
                        if (response.data.status === false) {
                            alert(response.data.data);
                            return false;
                        }

                        if ( ! response.data.items) {
                            response.data.items = [];
                        }

                        this.$store.commit('populate', {items: response.data.items, total: response.data.totalItems});
                        return true;
                    })
                    .catch(function (error) {
                        alert(error);
                    });

                console.log('Search fired.');
            }
        }
    }
</script>
