//アコーディオン
$(function () {
  //.accordion_oneの中の.accordion_headerがクリックされたら
  $('.main-category-li').click(function () {
    //クリックされた.accordion_oneの中の.accordion_headerに隣接する.accordion_innerが開いたり閉じたりする。
    $(this).next('.sub-category-ul').slideToggle();
    $(this).toggleClass("active");
  });
});

$(function () {
  //.accordion_oneの中の.accordion_headerがクリックされたら
  $('.add-main-category-li').click(function () {
    //クリックされた.accordion_oneの中の.accordion_headerに隣接する.accordion_innerが開いたり閉じたりする。
    $(this).next('.add-sub-category-ul').slideToggle();
    $(this).toggleClass("active");
  });
});

//POST いいね機能 ajax
$(function () {
  $('.like-toggle').on('click', function () {
    let $this = $(this);
    let likeReviewId = $this.data('post-id');

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/like',
      method: 'POST',
      data: {
        'post_id': likeReviewId
      },
    })

      .done(function (data) {
        if ($this.attr('src') === "http://localhost/images/heart.png") {
          $this.attr('src', "http://localhost/images/heart_border.png");
        } else {
          $this.attr('src', "http://localhost/images/heart.png");
        }
        $this.next('.post-heart').html(data.post_likes_count);
      })
      .fail(function () {
        console.log('fail');
      });
  })
});


//COMMENT いいね機能 ajax
$(function () {
  $('.comment-like-toggle').on('click', function () {
    let $this = $(this);
    let likeCommentId = $this.data('comment-id');

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/comment/like',
      method: 'POST',
      data: {
        'post_comment_id': likeCommentId
      },
    })

      .done(function (data) {
        if ($this.attr('src') === "http://localhost/images/heart.png") {
          $this.attr('src', "http://localhost/images/heart_border.png");
        } else {
          $this.attr('src', "http://localhost/images/heart.png");
        }
        $this.next('.post-heart').html(data.comment_likes_count);
      })
      .fail(function () {
        console.log('fail');
      });
  })
});
