<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputText from 'primevue/inputtext';
import Card from 'primevue/card';
import Button from 'primevue/button';
import {useForm} from "@inertiajs/vue3";
import {useToast} from "primevue/usetoast";
import Calendar from 'primevue/calendar';
import Dropdown from 'primevue/dropdown';
import InputNumber from 'primevue/inputnumber';
import ProgressBar from 'primevue/progressbar';
import {onMounted, ref} from "vue";
import Toast from 'primevue/toast';
import moment from "moment/moment";

const props = defineProps({
    model: Object,
    types: Object,
    bodies: Object,
    fuels: Object,
    countries: Object,
    brands: Object,
});

const toast = useToast();
let dropdownBodies = ref();
let dropdownFuels = ref();
let dropdownTypes = ref();

const form = useForm({
    name: props.model.name,
    type: props.model.type,
    engine_model: props.model.engine_model,
    engine_number: props.model.engine_number,
    engine_capacity: props.model.engine_capacity,
    cylinders_count: props.model.cylinders_count,
    engine_power: props.model.engine_power,
    max_torque: props.model.max_torque,
    max_speed: props.model.max_speed,
    acceleration_time: props.model.acceleration_time,
    doors_count: props.model.doors_count,
    seats_count: props.model.seats_count,
    length: props.model.length,
    width: props.model.width,
    height: props.model.height,
    fuel: props.model.fuel,
    fuel_consumption_90: props.model.fuel_consumption_90,
    fuel_consumption_120: props.model.fuel_consumption_120,
    fuel_consumption_city: props.model.fuel_consumption_city,
    brand_id: {
        id: props.model.brand.id,
        name: props.model.brand.name
    },
    country_id: {
        id: props.model.country.id,
        name: props.model.country.name
    },
    body: props.model.body,
    release_date: moment(props.model.release_date).format("YYYY"),
});

onMounted(() => {
    dropdownBodies.value = [];
    dropdownTypes.value = [];
    dropdownFuels.value = [];
    Object.entries(props.bodies).forEach(entry => {
        const [key, value] = entry;
        dropdownBodies.value.push({option: value, value: key})
    })
    Object.entries(props.types).forEach(entry => {
        const [key, value] = entry;
        dropdownTypes.value.push({option: value, value: key})
    })
    Object.entries(props.fuels).forEach(entry => {
        const [key, value] = entry;
        dropdownFuels.value.push({option: value, value: key})
    })
});

const update = () => {
    form.transform((data) => ({
        ...data,
        brand_id: data.brand_id ? data.brand_id.id : null,
        country_id: data.country_id ? data.country_id.id : null,
        release_date: moment(data.release_date).format("YYYY-MM-DD"),
    }))
        .put(route('crm.models.update', [props.model.id]), {
        onSuccess: () => {
            toast.add({ severity: 'success', summary: 'Успешно', detail: 'Модель обновлена', life: 3000 });
        },
        onError: () => {
            toast.add({ severity: 'error', summary: 'Ошибка', detail: 'Произошла ошибка', life: 3000 });
        },
    });
};
</script>

<template>
    <AppLayout title="Модели">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Модели
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Card>
                        <template #title>
                            Редактирование модели
                            <Toast />
                        </template>
                        <template #content>
                            <div class="space-y-8">
                                <div class="card flex flex-column md:flex-row gap-3">
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.name : ''" >
                                            <InputText v-model.trim="form.name" v-bind:disabled="form.processing" required="true" autofocus :class="{'p-invalid': form.hasErrors && form.errors.name}"/>
                                            <label>Наименование</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.brand_id : ''">
                                            <Dropdown v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.brand_id}" v-model="form.brand_id" :options="brands" filter optionLabel="name">
                                                <template #value="slotProps">
                                                    <div v-if="slotProps.value" class="flex align-items-center">
                                                        <div>{{ slotProps.value.name }}</div>
                                                    </div>
                                                </template>
                                                <template #option="slotProps">
                                                    <div class="flex align-items-center">
                                                        <div>{{ slotProps.option.name }}</div>
                                                    </div>
                                                </template>
                                            </Dropdown>
                                            <label>Марка</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.country_id : ''">
                                            <Dropdown v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.country_id}" v-model="form.country_id" :options="countries" filter optionLabel="name">
                                                <template #value="slotProps">
                                                    <div v-if="slotProps.value" class="flex align-items-center">
                                                        <div>{{ slotProps.value.name }}</div>
                                                    </div>
                                                </template>
                                                <template #option="slotProps">
                                                    <div class="flex align-items-center">
                                                        <div>{{ slotProps.option.name }}</div>
                                                    </div>
                                                </template>
                                            </Dropdown>
                                            <label>Страна</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.release_date : ''">
                                            <Calendar v-model="form.release_date" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.release_date}" view="year" dateFormat="yy" />
                                            <label>Год выпуска</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.type : ''">
                                            <Dropdown v-model="form.type" :options="dropdownTypes" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.type}" optionLabel="option" optionValue="value" class="w-full md:w-14rem" />
                                            <label>Тип</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.body : ''">
                                            <Dropdown v-model="form.body" :options="dropdownBodies" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.body}" optionLabel="option" optionValue="value" class="w-full md:w-14rem" />
                                            <label>Кузов</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="card flex flex-column md:flex-row gap-3">
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.doors_count : ''">
                                            <InputNumber :useGrouping="false" v-model.trim="form.doors_count" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.doors_count}" />
                                            <label>Количество дверей</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.seats_count : ''">
                                            <InputNumber :useGrouping="false" v-model.trim="form.seats_count" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.seats_count}" />
                                            <label>Количество сидений</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.length : ''">
                                            <InputNumber :useGrouping="false" suffix=" мм" v-model.trim="form.length" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.length}" />
                                            <label>Длина</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.width : ''">
                                            <InputNumber :useGrouping="false" suffix=" мм" v-model.trim="form.width" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.width}" />
                                            <label>Ширина</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.height : ''">
                                            <InputNumber :useGrouping="false" suffix=" мм" v-model.trim="form.height" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.height}" />
                                            <label>Высота</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="card flex flex-column md:flex-row gap-3">
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.engine_model : ''">
                                            <InputText v-model.trim="form.engine_model" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.engine_model}" />
                                            <label>Модель двигателя</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.engine_number : ''">
                                            <InputText v-model.trim="form.engine_number" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.engine_number}" />
                                            <label>Номер двигателя</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.cylinders_count : ''">
                                            <InputNumber :useGrouping="false" v-model.trim="form.cylinders_count" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.cylinders_count}" />
                                            <label>Количество цилиндров</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="card flex flex-column md:flex-row gap-3">
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.engine_capacity : ''">
                                            <InputNumber :useGrouping="false" suffix=" см3" v-model.trim="form.engine_capacity" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.engine_capacity}" />
                                            <label>Рабочий объем двигателя</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.engine_power : ''">
                                            <InputNumber :useGrouping="false" suffix=" л.с." v-model.trim="form.engine_power" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.engine_power}" />
                                            <label>Мощность двигателя</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.max_torque : ''">
                                            <InputNumber :useGrouping="false" suffix=" Нм" v-model.trim="form.max_torque" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.max_torque}" />
                                            <label>Максимальный крутящий момент</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="card flex flex-column md:flex-row gap-3">
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.max_speed : ''">
                                            <InputNumber :useGrouping="false" suffix=" км/ч" v-model.trim="form.max_speed" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.max_speed}" />
                                            <label>Максимальная скорость</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.acceleration_time : ''">
                                            <InputNumber :useGrouping="false" suffix=" с" :minFractionDigits="1" v-model.trim="form.acceleration_time" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.acceleration_time}" />
                                            <label>Время разгона до 100км/ч</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.fuel : ''">
                                            <Dropdown v-model="form.fuel" :options="dropdownFuels" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.fuel}" optionLabel="option" optionValue="value" class="w-full md:w-14rem" />
                                            <label>Используемый вид топлива</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="card flex flex-column md:flex-row gap-3">
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.fuel_consumption_90 : ''">
                                            <InputNumber :useGrouping="false" suffix=" л/100км" :minFractionDigits="1" v-model.trim="form.fuel_consumption_90" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.fuel_consumption_90}" />
                                            <label>Расход топлива при скорости 90 км/ч</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.fuel_consumption_120 : ''">
                                            <InputNumber :useGrouping="false" suffix=" л/100км" :minFractionDigits="1" v-model.trim="form.fuel_consumption_120" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.fuel_consumption_120}" />
                                            <label>Расход топлива при скорости 120 км/ч</label>
                                        </span>
                                    </div>
                                    <div class="p-inputgroup">
                                        <span class="p-float-label" v-tooltip="form.hasErrors ? form.errors.fuel_consumption_city : ''">
                                            <InputNumber :useGrouping="false" suffix=" л/100км" :minFractionDigits="1" v-model.trim="form.fuel_consumption_city" v-bind:disabled="form.processing" required="true" :class="{'p-invalid': form.hasErrors && form.errors.fuel_consumption_city}" />
                                            <label>Расход топлива при городском цикле</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="card flex justify-end mx-4">
                                    <Button v-bind:disabled="form.processing" @click="update" label="Обновить" />
                                </div>
                            </div>
                            <ProgressBar v-if="form.processing" class="mt-8" mode="indeterminate" style="height: 3px"></ProgressBar>
                        </template>
                    </Card>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
