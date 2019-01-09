<template>
    <div>
        <div>
            <form v-on:submit.prevent="clear_and_search">
                <input type="text" placeholder="Search here, e.g. 'Gianni Rodari'" v-model="search_string">
                <input type="submit" value="search">
            </form>

            <div v-if="this.$store.state.fired">
                <div v-for="item in this.$store.state.items">
                    &nbsp;<br>
                    ID: {{ item.id }}<br>
                    Title: {{ item.volumeInfo.title }}<br>
                    Authors: {{ item.volumeInfo.authors }}<br>
                    Publisher: {{ item.volumeInfo.publisher }}<br>
                    Published Date: {{ item.volumeInfo.publishedDate }}<br>
                    <span v-if="item.volumeInfo.imageLinks">
                        Image: <img :src="item.volumeInfo.imageLinks.thumbnail"><br>
                    </span>
                </div>

                <button @click="search" v-if="this.$store.state.items.length < this.$store.state.total">
                    Load more
                </button>

                {{ this.$store.state.items.length }}/{{ this.$store.state.total }} (page {{ this.$store.state.page }})
            </div>
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
