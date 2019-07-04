<template>
  <div>
    <v-toolbar flat>
      <v-toolbar-title>Piket</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark class="mb-2" v-on="on">Piket Baru</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.kode" label="Kode Piket"></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-text-field
                    v-model="editedItem.jam_masuk"
                    placeholder="00:00"
                    :mask="jam"
                    label="Jam Masuk"
                  ></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-text-field
                    v-model="editedItem.jam_pulang"
                    placeholder="00:00"
                    :mask="jam"
                    label="Jam Pulang"
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-select
                    v-model="editedItem.hari_masuk"
                    :items="hari"
                    label="Hari Masuk"
                    item-text="name"
                    return-object
                    multiple
                    chips
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="editedItem.keterangan" label="Keterangan"></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
            <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-card>
      <v-card-title>
        Data Piket
        <v-spacer></v-spacer>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      </v-card-title>
      <v-data-table :headers="headers" :items="datatable" :search="search" class="elevation-1">
        <template v-slot:items="props">
          <td>{{ props.item.kode }}</td>
          <v-chip
            small
            v-for="(hari) in props.item.hari_masuk"
            color="primary"
            text-color="white"
            :key="hari.id"
          >{{hari.name}}></v-chip>
          <td>{{ props.item.jama_masuk }}</td>
          <td>{{ props.item.jama_pulang }}</td>
          <td>{{ props.item.keterangan }}</td>
          <td class="justify-center layout px-0">
            <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
            <v-icon small @click="deleteItem(props.item)">delete</v-icon>
          </td>
        </template>
        <template v-slot:no-data>
          <v-btn color="primary" @click="initialize">Reset</v-btn>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>

<script>
export default {
  data: () => ({
    jam: "##:##",
    hari: ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"],
    dialog: false,
    headers: [
      { text: "Kode", value: "name" },
      { text: "Hari Masuk", value: "name", sortable: false },
      { text: "Jam Masuk", value: "name" },
      { text: "Jam Pulang", value: "name" },
      { text: "Keterangan", value: "name" },
      { text: "Action", value: "name", sortable: false }
    ],
    search: "",

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
      axios.get("/api/piket").then(response => {
        this.datatable = response.data.data;
        console.log(response.data.data);
      });
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
        .delete("/api/piket/" + item.id)
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
        axios
          .put("/api/piket/" + this.editedItem.id, this.editedItem)
          .then(response => {
            console.log(response);
          });
      } else {
        axios
          .post("/api/piket/", {
            kode: this.editedItem.kode,
            jam_masuk: this.editedItem.jama_masuk,
            jam_pulang: this.editedItem.jam_pulang,
            hari_masuk: this.editedItem.hari_masuk.join(),
            keterangan: this.editedItem.keterangan
          })
          .then(response => {
            this.datatable.push(this.editedItem);
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

