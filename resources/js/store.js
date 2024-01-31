import Vue from 'vue';
import Vuex from 'vuex';

export default new Vuex.Store({
   state:{
       user: {}
   },
   mutations:{
       setUserState: (state, value) => state.user = value
   },
   actions:{
       userStateAction: () => {
           axios.get('api/user/me').then(response => {
               const userResponse = response.data.user
               commit('setUserState', userResponse);
           })
       }
   }
});
