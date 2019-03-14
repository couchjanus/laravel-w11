<template>
  <div class="card my-4">
    <span v-if="currentUser!==undefined">
      <h5 class="card-header">Leave a Comment:</h5>
      <div class="card-body">
        <form action @submit.prevent="createComment()">
          <div class="input-group form-group">
            <textarea
              name="body"
              v-model="comment.body"
              ref="textarea"
              class="form-control"
              rows="3"
            ></textarea>
          </div>
          <div class="input-group">
            <button type="submit" class="btn btn-primary">Add Comment</button>
          </div>
        </form>
      </div>
    </span>
    <!-- Single Comment -->
    <h4>Comments</h4>
    <ul class="list-group list-group-flush">
      <li class="list-group-item" v-for="comment in comments">
        <h3>{{comment.creator.name}} </h3>  <time>{{comment.created_at}}</time>
        <div class="media-body">{{comment.body}}</div>
      </li>
    </ul>
    <ul v-if="errors && errors.length">
      <li v-for="error of errors">{{error.message}}</li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ["currentId", "currentUser"],

  data: () => ({
    comments: [],
    comment: {
      body: ""
    },
    errors: []
  }),

  created: function() {
    this.fetchComments();
  },

  methods: {
    fetchComments: function() {
      axios
        .get("../api/post/" + this.currentId + "/comments")
        .then(response => {
          this.comments = response.data;
          console.log(this.comments);
        })
        .catch(error => {
          this.errors.push(error);
        });
    },

    createComment: function() {
      axios
        .post("../api/post/" + this.currentId + "/comment", this.comment)
        .then(response => {
          this.comment.body = "";
          this.fetchComments();
        })
        .catch(error => {
          this.comment.body = "";
          this.fetchComments();
        });
    }
  }
};
</script>
