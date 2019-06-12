export default class Gate{

  constructor(user){
    this.user = user;

  }

  isAdmin(){
    return this.user.usertype === 'admin';
  }

  isUser(){
      return this.user.usertype === 'user';
  }

  isEditor(){
      return this.user.usertype === 'editor';
  }

  isAuthor(){
      return this.user.usertype === 'author';
  }

  isAdminOrEditor(){
      if(this.user.usertype === 'admin' || this.user.usertype === 'editor'){
        return true;
      }
  }

}
