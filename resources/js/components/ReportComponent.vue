<template>
  <div>
    <vue-good-table
      :columns="columns"
      :rows="rows"
      :search-options="{
        enabled: true,
      }"
      :pagination-options="{
        enabled: true,
        mode: 'records',
      }"
      styleClass="vgt-table condensed"
    />
  </div>
</template>

<script>
export default {
  name: "report-component",
  data() {
    return {
      columns: [
        {
          label: "ID",
          field: "id",
        },
        {
          label: "Tag",
          field: "Tag",
          type: "string",
        },
        {
          label: "Placa",
          field: "LicensePlate",
          type: "string",
        },
        {
          label: "Created On",
          field: "created_at",
          type: "date",
          dateInputFormat: "yyyy-MM-dd HH:mm:ss",
          dateOutputFormat: "MMM do yy",
        },

      ],
      rows: [],
    };
  },
  methods: {
    async fetchData() {
      try {
        const { data } = await axios.get("tagReport");
        console.log(data);
        data.forEach((element) => {
          this.rows.push(element);
        });
      } catch {
        console.log("error fetching tagReport");
      }
    },
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
