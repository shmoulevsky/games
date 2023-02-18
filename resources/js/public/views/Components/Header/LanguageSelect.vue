<template>
    <div class="custom-select"  @blur="open = false">
        <div class="selected" :class="{ open: open }" @click="open = !open">
            {{ this.languages.filter((item) => {return parseInt(item.id) === parseInt(this.currentLanguageId)
        })[0].name ?? '-'}}
        </div>
        <div class="items" :class="{ selectHide: !open }">
            <div
                v-for="language in languages"
                :key="language.id"
                @click="changeValue(language.id)">
                {{ language.name }}
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "LanguageSelect",
    data(){
        return {
            currentLanguageId: this.$store.getters.getLanguage ?? null,
            open: false
        }
    },
    computed: {
        languages() { return this.$store.getters.getLanguages }
    },
    methods : {
      changeValue(languageId){
          this.currentLanguageId = languageId;
          this.open = false;
          this.$store.dispatch('setLanguage', languageId)
      }
    },
    created() {

    },
    mounted() {
        setTimeout(()=> {
            this.$emit("input", this.selected);
        }, 10)

    },

}
</script>

<style scoped>
.custom-select {
    position: relative;
    width: 120px;
    text-align: left;
    outline: none;
    height: 47px;
    line-height: 47px;
}

.custom-select .selected {
    background-color: transparent;
    border-radius: 6px;
    color: #111;
    padding-left: 1em;
    cursor: pointer;
    user-select: none;
}

.custom-select .selected.open {

}

.custom-select .selected:after {
    position: absolute;
    content: "";
    top: 22px;
    right: 1em;
    width: 0;
    height: 0;
    border: 5px solid transparent;
    border-color: #ccc transparent transparent transparent;
}

.custom-select .items {
    color: #111;
    border-radius: 0px 0px 6px 6px;
    overflow: hidden;
    position: absolute;
    background-color: #fafafa;
    left: 0;
    right: 0;
    z-index: 1;
}

.custom-select .items div {
    color: #111;
    padding-left: 1em;
    cursor: pointer;
    user-select: none;
}

.custom-select .items div:hover {
    background-color: #6e41e2;
    color: #fff;
}

.selectHide {
    display: none;
}
</style>
