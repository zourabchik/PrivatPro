export const user = {
  state: () => ({
    userData: {
      id: 0,
      firstName: "",
      lastName: "",
      middleName: "",
      phone: "",
      email: "",
      createdAt: "",
      updatedAt: "",
      roles: []
    },
    token: ""
  }),
  getters: {
    userData(state) {
      return state.userData;
    },
    token(state) {
      return state.token;
    }
  },
  mutations: {
    setUserData(state, userData) {
      state.userData = userData;
    },
    setToken(state, token) {
      state.token = token;
    }
  },
  actions: {
    setUserData({ commit }, userData) {
      if (Object.keys(userData)?.length) {
        commit("setUserData", userData);
      }
    },
    setToken({ commit }, token) {
      if (token) {
        commit("setToken", token);
      }
    }
  },
  namespaced: true
};
