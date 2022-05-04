<template>
    <div class="addItem">
        <form @submit.prevent="addItem()">
            <input type="text" v-model="name" placeholder="что же мне сделать..."/>
            <button type="submit" class="btn btn-primary" style="position: relative; left: 35%;">Добавить</button>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            name: "",
        };
    },
    methods: {
        addItem() {
            if (this.name == "") {
                return;
            }
            axios
                .post("api/item/store", { name: this.name, text: 'test' })
                .then((respone) => {
                    console.log(respone.status)
                    if (respone.status == 200) {
                        this.name = "";
                        this.$emit("reloadlist");
                    }
                })
                .catch((er) => {
                    console.log(er);
                });
        },
    },
};
</script>

<style scoped>
.addItem {
    display: flex;
    justify-content: center;
    align-items: center;
}
input {
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}
.plus {
    font-size: 20px;
}
.active {
    color: #00ce25;
}
.inactive {
    color: #999999;
}
</style>