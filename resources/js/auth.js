export default class Auth {
    constructor(access) {
        this.user = access;
    }

    roles() {
        return this.user.roles.map(role => role.name);
    }

    permission() {
        return this.user.permission.map(permision => permision.name);
    }

    isAdmin() {
        return this.roles().includes("Admin");
    }
}
