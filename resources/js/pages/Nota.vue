<template>
  <div>
    <v-toolbar flat>
      <v-toolbar-title>Nota</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
    </v-toolbar>
    <v-data-table :headers="headers" :items="datatable" class="elevation-1">
      <template v-slot:items="props">
        <td>{{ props.item.id }}</td>
        <td>{{ props.item.kode }}</td>
        <td>{{ props.item.nama_pelanggan}}</td>
        <td>{{ props.item.total }}</td>
        <td>{{ props.item.created_at }}</td>
        <td class="justify-center layout px-0">
          <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
          <v-icon small @click="deleteItem(props.item)">delete</v-icon>
        </td>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    headers: [
      { text: "ID", value: "name" },
      { text: "Kode Nota", value: "name" },
      { text: "Nama Pelanggan", value: "name" },
      { text: "Total Pembelian", value: "name" },
      { text: "Tanggal Transaksi", value: "name" },
      { text: "Actions", value: "name", sortable: false }
    ],

    datatable: [],
    editedIndex: -1,
    editedItem: {},
    defaultItem: {}
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      axios
        .get("/api/nota")
        .then(response => (this.datatable = response.data.data));
    },

    editItem(item) {
      this.editedIndex = this.datatable.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.datatable.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.datatable.splice(index, 1);
      axios
        .delete("/api/nota/" + item.id)
        .then(response => console.log(response.data));
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.datatable[this.editedIndex], this.editedItem);
        axios.put("/api/nota/" + this.editedItem.id, this.editedItem);
      } else {
        this.datatable.push(this.editedItem);
        axios
          .post("/api/nota/", this.editedItem)
          .then(response => {
            console.log(response.data);
          })
          .catch(err => console.log(err));
      }
      this.close();
    }
  }
};
</script>

<style>
</style>
