<template>
                    <div class="relative my-32">
                        <button @click="update"
                            class="relative z-10 rounded-md bg-white p-2 focus:outline-none">
                            <span class="relative inline-flex rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="gray">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span v-if="notifications.length > 0"  class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75">
                                    </span>
                                    <span class="object-right-top inline-flex rounded-full h-3 w-3 bg-blue-500"></span>

                                </span>
                              </span>
                        </button>
                        <div v-show="dropdownOpen" @click="dropdownOpen = false"
                            class="fixed inset-0 h-full w-full z-10">
                        </div>
                        <div v-show="dropdownOpen"
                            class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20"
                            style="width:20rem; display:none">
                                <div v-for="notification in notifications" :key="notification.id" class="py-2">
                                    <span  class="cursor-pointer flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                        <p class="text-gray-600 visited:text-medium-gray-400 text-sm mx-2">
                                            <span class="font-bold">
                                                {{ notification.Message }}</span>
                                        </p>
                                    </span>
                                </div>
                            <a :href="seeallurl"
                                class="block bg-gray-800 text-white text-center font-bold py-2">See all
                                notifications</a>
                        </div>
                    </div>

</template>

<script>
export default {
  name: "notification-component",

  props:['seeallurl'],

  data() {
    return {
      dropdownOpen: false,
      notifications:[]
    };
  },
  methods: {
    async fetchData() {
      try {
        const { data } = await axios.get("unreadNotifications");
        console.log(data);
        data.forEach((element) => {
          this.notifications.push(element);
        });
      } catch {
        console.log("error fetching unreadNotifications");
      }
    },

    async update(){
      this.dropdownOpen = !this.dropdownOpen;
      try{
        await axios.post("updateNotifications", {notifications: this.notifications});
      } catch {
        console.log("error fetching unreadNotifications");
      }
    }
  },

  async created() {
        await this.fetchData();
        //  Echo.private("MapLocationChannel").listen("LiveFeedUpdate", e => {
        //     console.log(e);
        //     this.notifications.push({
        //         id: e.id,
        //         Message: e.Message ? e.Message : null,
        //         Read: e.Read

        //     });
        // });
    }
};
</script>
