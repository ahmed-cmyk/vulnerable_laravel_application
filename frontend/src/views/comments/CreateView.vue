<template>
  <div class="card">
    <h2 class="bold font-subheading">Add Comment</h2>
    <form @submit.prevent="addComment">
      <div class="p-10">
        <textarea rows="5" cols="100" v-model="comment"></textarea>
        <button class="btn btn-primary" type="submit">Submit</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      comment: "",
      id: this.$route.params.id,
    };
  },
  computed: {
    user() {
      return this.$store.state.user.user;
    },
  },
  methods: {
    async addComment() {
      const status = await this.$store.dispatch("addComment", {
        body: {
          blog_id: this.id,
          comment: this.comment,
          author: this.user.name,
        },
      });
      console.log(status);
      if (status === 201) {
        this.$emit("created");
        this.$store.dispatch("setMessage", "Comment added successfully");
        // this.$store.dispatch("getComments", { blog_id: this.id });
      }
    },
  },
};
</script>
