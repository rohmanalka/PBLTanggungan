class User {
    public String id;
    public String password;

    public User(String id, String password) {
        this.id = id;
        this.password = password;
    }

    public boolean login(String id, String password) {
        return this.id.equals(id) && this.password.equals(password);
    }
}
