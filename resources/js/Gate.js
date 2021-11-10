export default class Gate{
    constructor(user)
    {
        this.user=user;
    }
    isAdmin()
    {
        return this.user.usertype==='admin';
    }
    isUser()
    {
        return this.user.usertype==='user';
    }
}