<template>
    <div class="calendar-event container-fluid">
        <div class="calendar">
            <div class="calendar-header">
                <button @click="prevMonth">Previous</button>
                <span>{{ monthName }} {{ currentYear }}</span>
                <button @click="nextMonth">Next</button>
            </div>
            <div class="calendar-body">
                <div class="day-names">
                    <div v-for="day in dayNames" :key="day">{{ day }}</div>
                </div>
                <div class="days-grid">
                    <div v-for="day in days" :key="day.date" class="day" :class="{ 'empty': !day.isCurrentMonth }">
                        <div>{{ day.date.getDate() }}</div>
                        <div class="events">
                            <div v-for="event in day.events" :key="event.id" class="event">
                                {{ event.title }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed } from 'vue';

export default {
    setup() {
        const currentDate = ref(new Date());

        const events = ref([
            { id: 1, title: 'Meeting with Someone', date: new Date(2024, 5, 3) },
            { id: 2, title: 'Dentist Appointment', date: new Date(2024, 5, 5) },
            { id: 3, title: 'Dentist Conference Meeting', date: new Date(2024, 5, 18) }
        ]);

        const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        const currentMonth = computed(() => currentDate.value.getMonth());
        const currentYear = computed(() => currentDate.value.getFullYear());

        const monthName = computed(() => {
            const monthNames = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];
            return monthNames[currentMonth.value];
        });

        const days = computed(() => {
            const firstDayOfMonth = new Date(currentYear.value, currentMonth.value, 1);
            const lastDayOfMonth = new Date(currentYear.value, currentMonth.value + 1, 0);

            const daysArray = [];
            const startDay = firstDayOfMonth.getDay();
            const totalDays = lastDayOfMonth.getDate();

            for (let i = 0; i < startDay; i++) {
                daysArray.push({ date: new Date(currentYear.value, currentMonth.value, i - startDay + 1), isCurrentMonth: false, events: [] });
            }

            for (let i = 1; i <= totalDays; i++) {
                const date = new Date(currentYear.value, currentMonth.value, i);
                daysArray.push({ date, isCurrentMonth: true, events: events.value.filter(event => isSameDay(event.date, date)) });
            }

            const remainingDays = 42 - daysArray.length;
            for (let i = 1; i <= remainingDays; i++) {
                daysArray.push({ date: new Date(currentYear.value, currentMonth.value + 1, i), isCurrentMonth: false, events: [] });
            }

            return daysArray;
        });

        const prevMonth = () => {
            currentDate.value.setMonth(currentMonth.value - 1);
        };

        const nextMonth = () => {
            currentDate.value.setMonth(currentMonth.value + 1);
        };

        const isSameDay = (date1, date2) => {
            return date1.getFullYear() === date2.getFullYear() &&
                   date1.getMonth() === date2.getMonth() &&
                   date1.getDate() === date2.getDate();
        };

        return {
            dayNames,
            monthName,
            currentYear,
            days,
            prevMonth,
            nextMonth
        };
    }
}
</script>

<style>
.calendar-event {
    height: 100%;
    margin: 0;
    padding: 0;
    width: 100%;
}

.calendar-event {
    display: flex;
    justify-content: center;
    align-items: center;
}

.calendar {
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    height: 91vh;
    display: flex;
    flex-direction: column;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #f0f0f0;
    border-bottom: 1px solid #ccc;
}

.calendar-body {
    flex: 1;
    padding: 10px;
    display: flex;
    flex-direction: column;
}

.day-names, .days-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
}

.day-names div {
    text-align: center;
    font-weight: bold;
}

.days-grid {
    flex: 1;
    grid-auto-rows: 1fr;
}

.days-grid .day {
    text-align: center;
    padding: 10px;
    border-radius: 5px;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.days-grid .day.empty {
    color: #ccc;
}

.days-grid .events {
    margin-top: 5px;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.days-grid .event {
    background-color: #ffeb3b;
    border-radius: 3px;
    padding: 2px;
    font-size: 12px;
    text-align: left;
}
</style>
