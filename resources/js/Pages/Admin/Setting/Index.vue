<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import SettingField from "./SettingField.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";

const form = useForm({
    _method: "PUT",
    general_app_name: "",
    // general_app_description_value: "",
    // general_app_logo_value: "",
    // general_email_contact_value: "",
    // general_phone_value: "",
});
</script>

<template>
    <AdminLayout title="Setting">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Setting
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <JetFormSection>
                    <template #title>
                        <h4>Jump To</h4>
                    </template>

                    <template #description>
                        <ul
                            v-if="$page.props.settings.categories"
                            class="nav nav-pills flex-column"
                        >
                            <li
                                v-for="(category, index) in $page.props.settings
                                    .categories"
                                v-bind:key="index"
                                class="nav-item"
                            >
                                <a
                                    href="{{ url('admin/settings?category=' . category ) }}"
                                    class="nav-link"
                                    >{{ category }}</a
                                >
                            </li>
                        </ul>
                    </template>

                    <template #form>
                        <div
                            v-for="(setting, index) in $page.props.settings
                                .settings"
                            v-bind:key="index"
                            class="col-span-6 sm:col-span-4"
                        >
                            <JetLabel :for="setting.key">
                                {{ setting.name }}
                            </JetLabel>

                            <div class="col-sm-6 col-md-9">
                                <setting-field :setting="setting" />
                            </div>
                        </div>
                    </template>

                    <template #actions>
                        <JetActionMessage
                            :on="form.recentlySuccessful"
                            class="mr-3"
                        >
                            Saved.
                        </JetActionMessage>
                        <JetButton
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Save Changes
                        </JetButton>

                        <button class="ml-4" type="button">Reset</button>
                    </template>
                </JetFormSection>
            </div>
        </div>
    </AdminLayout>
</template>
