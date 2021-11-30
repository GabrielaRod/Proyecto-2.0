<template>
  <div>
    <vue-good-table
      :columns="columns"
      :rows="dataFiltered"
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
  name: "tag-report-component",
  data() {
    return {
      columns: [
        {
          label: "ID",
          field: "id",
        },
        {
          label: "Tag",
          field: "data",
          type: "string",
        },
        {
          label: "Ubicación",
          field: "location",
          type: "string",
        },
      ],
      rows: [],
    };
  },
  methods: {
    async fetchData() {
      try {
        const { data } = await axios.get("live");
        console.log(data);
        data.forEach((element) => {
          this.rows.push(element);
        });
      } catch {
        console.log("error fetching live");
      }
    },
  },
    computed: {
        dataFiltered() {
            return this.rows
                .sort((a, b) => b.id - a.id)
                .map(x => {
                    const kk = x.data
                        ? JSON.parse(x.data.replaceAll("'", '"'))
                        : x.data;
                    return {
                        data: kk.macAddress,
                        id: x.id,
                        location: x.location
                    };
                });
        }
    },
  async created() {
        await this.fetchData();
    }
};
</script>
