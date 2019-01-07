<template>
    <div>
        <div>
            <input placeholder="search here, e.g. 'Gianni Rodari'" v-model="search_string">
            <button @click="search">
                search
            </button>

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

                {{ this.$store.state.items.length }}/{{ this.$store.state.total }}
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
            search() {
                axios.get('/search?search=' + this.search_string)
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
