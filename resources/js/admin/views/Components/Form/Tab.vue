<template>
        <div class="list-group list-group-horizontal-sm mb-1 text-center col-4 mb-3" role="tablist">
            <a v-for="(tab, key) in tabs"
               :key="'tab' + key"
               :class="tab.active ? 'active' : ''"
               class="list-group-item list-group-item-action"
               :id="'tab-list'+key"
               data-bs-toggle="list"
               :href="'#tab' + key"
               role="tab">{{tab.title}}
            </a>
        </div>
        <div class="tab-content text-justify">
            <div v-for="(tab, key) in tabs"
                 :key="'tab-wrap' + key"
                 :class="tab.active ? 'active show' : ''"
                 :id="'tab'+key"
                 class="tab-pane fade"
                 role="tabpanel"
                 :aria-labelledby="'tab-list'+key">
                <slot name="tabContent" :tab="tab"></slot>
            </div>
        </div>
</template>

<script>
export default {
    name: "Tab",
    props : ["tabs"],
    mounted() {
    },
}
</script>

<style scoped>

</style>
