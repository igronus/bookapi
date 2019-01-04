<template>
    <div>
        <div>
            <input placeholder="search here" v-model="search_string">
            <button @click="search">
                search
            </button>

            <div v-if="this.$store.state.fired">
                <ul>
                    <li v-for="item in this.$store.state.items">
                        {{ item.id }}
                    </li>
                </ul>

                {{ this.$store.state.items.length }}/{{ this.$store.state.total }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return  {
                search_string: 'test'
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
