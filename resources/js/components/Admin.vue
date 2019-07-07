<template>
  <v-app id="inspire" dark>
    <v-navigation-drawer v-model="drawer" clipped fixed app>
      <v-list dense>
        <v-list-tile to="/admin/">
          <v-list-tile-action>
            <v-icon>dashboard</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Dashboard</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>

        <v-list-group v-if="$auth.isAdmin()">
          <v-list-tile slot="activator">
            <v-list-tile-action>
              <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>User Management</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-tile to="/admin/users">
            <v-list-tile-action>
              <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Users</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-tile to="/admin/roles">
            <v-list-tile-action>
              <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Roles</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-tile to="/admin/permission">
            <v-list-tile-action>
              <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Permissions</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list-group>

        <v-list-tile to="/admin/setting/">
          <v-list-tile-action>
            <v-icon>settings</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Settings</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>

        <v-list-group>
          <v-list-tile slot="activator">
            <v-list-tile-action>
              <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Pembelian</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-tile to="/admin/kategori/">
            <v-list-tile-action>
              <v-icon>settings</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Kategori</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-tile to="/admin/barang/">
            <v-list-tile-action>
              <v-icon>settings</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Barang</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-tile to="/admin/suplier/">
            <v-list-tile-action>
              <v-icon>settings</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Suplier</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list-group>

        <v-list-group>
          <v-list-tile slot="activator">
            <v-list-tile-action>
              <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Penjualan</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-tile to="/admin/nota/">
            <v-list-tile-action>
              <v-icon>settings</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Nota</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-tile to="/admin/transaksi/">
            <v-list-tile-action>
              <v-icon>settings</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Transaksi</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list-group>

        <v-list-group>
          <v-list-tile slot="activator">
            <v-list-tile-action>
              <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Karyawan</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-tile to="/admin/jabatan/">
            <v-list-tile-action>
              <v-icon>settings</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Jabatan</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-tile to="/admin/piket/">
            <v-list-tile-action>
              <v-icon>settings</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Piket</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>

          <v-list-tile to="/admin/pegawai/">
            <v-list-tile-action>
              <v-icon>settings</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Data Pegawai</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list-group>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar app fixed clipped-left>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>Application</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn @click="logout()">
        <v-icon>account_circle</v-icon>
      </v-btn>
      <v-menu
        offset-y
        origin="center center"
        class="elelvation-1"
        :nudge-bottom="14"
        transition="scale-transition"
      >
        <v-btn @click="readnotif()" icon flat slot="activator">
          <v-badge color="red" overlap>
            <span slot="badge">{{this.notifications.length}}</span>
            <v-icon medium>notifications</v-icon>
          </v-badge>
        </v-btn>

        <v-list>
          <v-list-tile v-for="notification in notifications" :key="notification.id">
            <v-list-tile-content>
              <v-list-tile-title>{{notification.data.createdUser.name}}has just registered</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-menu>
    </v-toolbar>

    <v-content>
      <v-container fluid fill-height>
        <v-layout>
          <v-flex>
            <router-view></router-view>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
    <v-footer app fixed>
      <span>&copy; 2017</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    drawer: null,
    notifications: []
  }),
  props: {
    source: String,
    user: ""
  },
  created() {
    this.notifications = this.user.notifications.filter(notification => {
      return notification.read_at == null;
    });
    //console.log(this.notifications);

    Echo.private("App.User." + this.user.id).notification(notification => {
      console.log(notification.notification);
      this.notifications.push(notification.notification);
    });
  },
  // computed: {
  //   unreadnotif() {
  //     return this.notifications.filter(
  //       notification => notification.read_at == null
  //     );
  //   }
  // }

  methods: {
    logout() {
      axios.post("/logout").then(this.$router.push("/"));
    },

    readnotif() {
      axios
        .get("/readnotif/" + this.user.id)
        .then(() => (this.notifications = []))
        .catch(err => console.log(err));
    }
  }
};
</script>


<style>
</style>
