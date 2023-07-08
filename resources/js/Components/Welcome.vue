<script setup>
import {Select} from 'flowbite-vue'
import {ref} from 'vue'
import {Accordion, AccordionPanel, AccordionHeader, AccordionContent} from 'flowbite-vue'
import {ListGroup, ListGroupItem} from 'flowbite-vue'
import {Spinner} from 'flowbite-vue'

import {Tabs, Tab} from 'flowbite-vue'

defineProps({
    employees: Array,
})
const teacher = ref('');
const isLoading = ref(false)
const lessons = ref(null);
const activeTab = ref(null)

function lookupTimetable() {

    if (teacher) {
        isLoading.value = true;
        fetch('/timetable?teacher=' + teacher.value)
            .then(response => response.json())
            .then(data => {
                lessons.value = data.data;
            }).finally(() => {

            isLoading.value = false
        });
    }

}
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <h1 class="text-2xl font-medium text-gray-900">
                Welcome, {{ $page.props.auth.user.name }}
            </h1>


            <p class="font-medium text-gray-900 mt-10 mb-5">Please select a teacher and date to view their timetable</p>

            <div class="columns-2">
                <div class="col-auto">
                    <Select
                        v-model="teacher"
                        :options="employees"
                        :searchable="true"
                        @change="lookupTimetable"
                    />
                </div>
            </div>


        </div>


        <div
            v-if="isLoading"
            class="p-6 lg:p-8 bg-white border-b border-gray-200"
        >
            <spinner size="12"/>
        </div>


        <div
            v-if="lessons"
            class="p-6 lg:p-8 bg-white border-b border-gray-200"
        >

            <tabs v-model="activeTab" class="p-5"> <!-- class appends to content DIV for all tabs -->
                <tab
                    v-for="(lesson, lessonDate) in lessons"
                    :name="lessonDate" :title="lessonDate">
                    <Accordion>
                        <accordion-panel v-for="detail in lesson">
                            <accordion-header>
                                {{ detail.start_time }} -{{ detail.end_time }}
                                <strong>{{ detail.name }} {{ detail.subject }} - {{ detail.room.name }}
                                    ({{ detail.room.code }})</strong>
                            </accordion-header>
                            <accordion-content>

                                <list-group>
                                    <list-group-item
                                        v-for="student in detail.students"
                                        :hover="false"
                                    >
                                        {{ student.surname }}, {{ student.forename }}
                                    </list-group-item>
                                </list-group>
                            </accordion-content>
                        </accordion-panel>
                    </Accordion>
                </tab>
            </tabs>

        </div>

    </div>
</template>
