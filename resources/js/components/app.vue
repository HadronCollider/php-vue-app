<template>
    <div id="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo List</h2>
            <add-form v-on:reloadlist="getList()" />
        </div>
        <list :items="items" v-on:reloadlist="getList()" />
    </div>
</template>
<script>
import addForm from "./addForm";
import list from "./list";
export default {
    components: {
        addForm,
        list,
    },
    data() {
        return {
            items: [],
        };
    },
    methods: {
        getList() {
            axios
                .get("api/items")
                .then((response) => {
                    this.items = response.data.data;
                    console.log(this.items);
                })
                .catch((er) => {
                    console.log(er);
                });
        },
    },
    created() {
        this.getList();
    },
};
</script>

<style scoped>
#todoListContainer {
    width: 350px;
    margin: auto;
}
.heading {
    background: #e6e6e6;
    padding: 10px;
}
#title {
    text-align: center;
}
</style>