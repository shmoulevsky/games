<template>
    <div class="form-group" v-if="field.type === 'text'">
        <text-input :field="field"></text-input>
    </div>
    <div class="form-group" v-else-if="field.type === 'textarea'">
        <text-area :field="field"></text-area>
    </div>
    <div class="form-group" v-else-if="field.type === 'select'">
        <select-list :field="field"></select-list>
    </div>
    <div class="form-group" v-else-if="field.type === 'checkbox'">
        <checkbox-list :field="field"></checkbox-list>
    </div>
    <div class="form-group" v-else-if="field.type === 'radio'">
        <radio-list :field="field"></radio-list>
    </div>
    <div class="form-group" v-else-if="field.type === 'file'">
        <file-input :field="field"></file-input>
    </div>
    <div v-else>--n/a type--</div>
</template>

<script>

import TextInput from "./Elements/TextInput";
import TextArea from "./Elements/TextArea";
import SelectList from "./Elements/SelectList";
import CheckboxList from "./Elements/CheckboxList";
import RadioList from "./Elements/RadioList";
import FileInput from "./Elements/FileInput";

export default {
    name: "AdminFields",
    components: {TextInput, TextArea, SelectList, CheckboxList, RadioList, FileInput},

    data(){

    },
    props : ["field"]
}
</script>

<style scoped>

</style>
