<template>
    <div>
        <div v-if="setting.setting_type == 'string'">
            <JetInput
                :id="setting.setting_key"
                v-model="setting[setting.setting_type + '_value']"
                type="text"
                :name="setting.setting_key"
                class="mt-1 block w-full"
            />
        </div>
        <div v-else class="custom-file">
            <JetInput
                :id="setting.setting_key"
                type="file"
                :name="setting.setting_key"
                class="mt-1 block w-full"
            />
            <JetLabel> Choose File </JetLabel>
        </div>
    </div>
</template>

<script setup>
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";

defineProps({
    setting: Object,
});
</script>
