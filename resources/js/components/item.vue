<template>
    <div class="item">
        <input
            type="checkbox"
            @change="updateCheck()"
            v-model="item.is_completed"
        />
        <span :class="[item.is_completed ? 'completed' : '', 'itemText']">
            {{ item.name }}
        </span>
        <button @click="removeItem()" class="trashcan">X</button>
    </div>
</template>
<script>
export default {
    props: ["item"],
    methods: {
        updateCheck() {
            axios
                .put("api/item/" + this.item.id, {
                    is_completed: this.item.is_completed,
                })
                .then((response) => {
                    if (response.status == 200) {
                        this.$emit("itemchanged");
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        removeItem() {
            axios
                .delete("api/item/" + this.item.id)
                .then((response) => {
                    if (response.status == 200) {
                        this.$emit("itemchanged");
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999;
}
.itemText {
    width: 80%;
    margin-left: 5%;
}
.item {
    display: flex;
    justify-content: center;
    align-items: center;
}
.trashcan {
    background: #e6e6e6;
    border: none;
    color: red;
    outline: none;
}
</style>