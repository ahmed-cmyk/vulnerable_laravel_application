import comments from "@/logic/comment";

export default {
  namespace: true,
  state: () => ({ comments: [] }),
  mutations: {
    setComments(state, data) {
      state.comments = data;
    },
    createComment(state, data) {
      state.comments = [...state.comments, data];
      console.log(state.comments);
    },
    emptyComments(state, data) {
      state.comments = data;
    },
  },
  actions: {
    async getComments(context, data) {
      const { blog_id } = data;
      const res = await comments.get(blog_id);

      if (res.status === 200) {
        context.commit("setComments", res.comments);
      }

      return res;
    },
    async addComment(context, data) {
      const { body, token } = data;
      const res = await comments.create(body, token);

      if (res.status === 201) {
        context.commit("createComment", res.comment);
      }

      return res.status;
    },
    async clearComments(context) {
      context.commit("emptyComments");
    },
  },
  getters: {
    getComments: (state) => {
      return state.comments;
    },
  },
};
