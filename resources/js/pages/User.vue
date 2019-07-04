<template>
  <div>
    <v-toolbar flat>
      <v-toolbar-title>My CRUD</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>

          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-text-field v-model="editedItem.password" label="Password"></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-select
                    v-model="editedItem.role"
                    :items="roles"
                    label="Roles"
                    item-text="name"
                    return-object
                    chips
                  ></v-select>
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
    <v-data-table :headers="headers" :items="userdata" class="elevation-1">
      <template v-slot:items="props">
        <td>{{ props.item.name }}</td>
        <td class="text-xs-left">{{ props.item.email }}</td>
        <td class="text-xs-right">{{ props.item.created_at}}</td>
        <td class="text-xs-right" v-if="props.item.role">
          <v-chip small color="primary" text-color="white">{{ props.item.role.name }}</v-chip>
        </td>
        <td class="text-xs-right" v-else>n/a</td>
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
      { text: "Username", value: "name" },
      { text: "Email", value: "email" },
      { text: "Created", value: "created_at" },
      { text: "Roles", value: "roles" },
      { text: "Actions", value: "name", sortable: false }
    ],

    userdata: [],
    roles: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      email: ""
    },
    defaultItem: {
      name: "",
      email: ""
    }
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
        .get("/api/users")
        .then(response => (this.userdata = response.data.data));
      axios
        .get("/api/roles")
        .then(response => (this.roles = response.data.data));
    },

    editItem(item) {
      this.editedIndex = this.userdata.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.userdata.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.userdata.splice(index, 1);
      axios.delete("/api/users/" + item.id);
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
        Object.assign(this.userdata[this.editedIndex], this.editedItem);
        axios
          .put("/api/users/" + this.editedItem.id, this.editedItem)
          .then(response => console.log(response.data));
      } else {
        this.userdata.push(this.editedItem);
        axios
          .post("/api/users/", this.editedItem)
          .then(response => console.log(response.data));
      }
      this.close();
    }
  }
};
</script>

<style>
</style>
