export default class Gate {

    constructor(user){
        this.user=user;
    }

    ownPost(user_id){
        return this.user.id===user_id;
    }

    Auth(){
        if(this.user)
            return true;
        return false;
    }
}
