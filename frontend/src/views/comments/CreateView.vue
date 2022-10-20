<template>
  <form>
    <textarea rows="5" cols="80"></textarea>
  </form>
</template>

<script>
export default {
  data() {
    return {
      comment: "",
      id: this.$route.params.id,
    };
  },
  methods: {
    async addComment() {
      const status = await this.$store.dispatch("updateBlog", {
        body: { id: this.id, title: this.title, body: this.body },
        token: this.token,
      });

      if (status === 200) {
        this.$store.dispatch("setMessage", "Comment added successfully");
      }
    },
  },
};
</script>
