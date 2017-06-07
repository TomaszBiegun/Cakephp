
<style>
    .person {
        margin: 10px 1px 0px 0px;
        background-color: rgba(97, 194, 52, 0.8);
        padding: 3px 5px 3px 5px;
        border-radius: 0px;
        color: white;
        cursor: pointer;
        font-size: 16px;
        font-weight: 400;

        -webkit-transition: background-color 200ms ease-in-out;
        -moz-transition: background-color 200ms ease-in-out;
        -ms-transition: background-color 200ms ease-in-out;
        -o-transition: background-color 200ms ease-in-out;
        transition: background-color 200ms ease-in-out;

        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .person:hover {
        background-color: rgba(103, 205, 56, 0.8);
    }

    .food-info {
        /*padding-top: 5px;*/

    }

    .active-stars {
        cursor: pointer;
    }

    .stars {
        font-size: 22px;
        color: #76d932;
        display: inline-block;
        float: left;

    }

    .non-voted-stars {
        font-size: 22px;
        color: #76d932;
        display: inline-block;
        float: left;

    }

    .food-components .active {
        color: rgba(0, 0, 0, 0.5);
        font-weight: bold;
        padding: 3px 4px 3px 4px;
    }


</style>
<section class="dish-area">


    <div class="container custom-container simply-box-container">

        <div class="day-bar">
            <a href="/users/mydiet" class="btn-green btn-back">
                Powrót
            </a>
        </div>

        <div class="simply-box">

            <div class="simple-inner-container">
                <div class="print-box">
                    <?php echo $this->Html->link('Drukuj', array('controller' => 'pages', 'action' => 'print_recipe'), array('class' => 'empty-green-btn print-recipe', 'data-id' => $recipe['Recipe']['id'])); ?>
                </div>
                <div class="col-sm-12 single-food">
                    <div class="row food-row">
                        <div class="col-xs-12  col-sm-3 food-image">
                            <!--                            <img src="img/home-page/collage/8.png"/>-->
                            <?php echo $this->Html->image('../odczyt/' . $recipe['Recipe']['basename']); ?>
                            <div class="food-info">
                                <div class="food-components" data-id="<?php echo $recipe['Recipe']['id']; ?>">
                                    <?php if ($control > 1): ?>
                                        <span class="person active">Razem</span>

                                        <?php foreach ($names as $name): ?>
                                            <span class="person"><?php echo $name; ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <h4 class="small-detail">Składniki</h4>
                                    <?php echo $this->Element('ingredients', array(
                                        'recipeProducts' => $recipeProducts
                                    )); ?>

                                </div>


                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-9 food-info">
                            <div class="food-rating">

                                <div class="stars starrr"
                                     data-rating="<?php echo $recipe['Recipe']['vote']; ?>"
                                     data-id="<?php echo $recipe['Recipe']['id']; ?> "
                                     data-vote="<?php echo $recipe['Recipe']['permission']; ?>"></div>


                                <h5 class="rating-info" id="info-<?php echo $recipe['Recipe']['id']; ?>">
                                    Ocena <?php echo $recipe['Recipe']['vote']; ?>/5</h5>
                            </div>
                            <div class="food-title">
                                <h3 class="tx-hand"> <?php echo $recipe['Recipe']['name']; ?></h3>
                                <a class="food-info" data-toggle="modal" data-target="#food-makro-info">
                                    <i class="fa fa-info-circle"></i>
                                </a>

                            </div>


                            <div class="food-prepare">
                                <h4 class="small-detail">Sposób przyrządzenia</h4>

                                <p><?php echo $recipe['Recipe']['preparation']; ?></p>

                            </div>
                            <?php if (($all_replacements != null) && !empty($all_replacements)): ?>

                                <div class="food-components-replacements">
                                    <h4 class="small-detail">Zamienniki <i class="fa fa-exchange"></i></h4>
                                    <ul class="food-components-replacement-list">
                                        <?php foreach ($all_replacements as $key => $replacements): ?>
                                            <li>
                                                <?php echo '<strong>' . $key . '</strong>'; ?> możesz zamienić na
                                                : <?php echo implode(", ", $replacements);; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            </div>


        </div>


    </div>


    <div class="modal fade" id="food-makro-info">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close modal-close faa-tada animated-hover" data-dismiss="modal"
                        aria-hidden="true">&times;</button>


                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <h4>Składniki odżywcze</h4>

                            <div>
                                Kaloryczność posiłku:
                                <span><?php echo round($summary['Kaloryczność posiłku'], 0); ?></span> kcal
                            </div>
                            <div>
                                Węglowodany: <span
                                    id="weglowodany"><?php echo round($summary['Węglowodany'], 0); ?></span> g
                            </div>
                            <div>
                                Białka: <span id="bialka"><?php echo round($summary['Białka'], 0); ?></span> g
                            </div>
                            <div>
                                Tłuszcze: <span id="tluszcze"><?php echo round($summary['Tłuszcze'], 0); ?></span> g
                            </div>


                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <!-- Chart.js -->
                            <script src="Chart.js/Chart.min.js"></script>
                            <canvas id="makro-chart" height="150" width="200"></canvas>

                            <div>
                                Białka: <span><?php echo $summary['Białka_proc']; ?></span>%
                            </div>
                            <div>
                                Węglowodany: <span><?php echo $summary['Węglowodany_proc']; ?></span>%
                            </div>
                            <div>
                                Tłuszcze: <span><?php echo $summary['Tłuszcze_proc']; ?></span>%
                            </div>

                            <script>
                                $("#food-makro-info").on('shown.bs.modal', function () {

                                    var data = [
                                        {
                                            value: $('#weglowodany').html(),
                                            color: "#61c234",
                                            highlight: "#76d932",
                                            label: "Węglowodany"
                                            //red
                                        },
                                        {
                                            value: $('#bialka').html(),
                                            color: "#6dab10",
                                            highlight: "#76d932",
                                            label: "Białka"
                                        },
                                        {
                                            value: $('#tluszcze').html(),
                                            color: "#4a8001",
                                            highlight: "#76d932",
                                            label: "Tłuszcze"
                                        }
                                    ];
                                    var options = {
                                        //Boolean - Whether we should show a stroke on each segment
                                        segmentShowStroke: true,

                                        //String - The colour of each segment stroke
                                        segmentStrokeColor: "#fff",

                                        //Number - The width of each segment stroke
                                        segmentStrokeWidth: 2,

                                        //Number - The percentage of the chart that we cut out of the middle
                                        percentageInnerCutout: 0, // This is 0 for Pie charts

                                        //Number - Amount of animation steps
                                        animationSteps: 100,

                                        //String - Animation easing effect
                                        animationEasing: "easeOutBounce",

                                        //Boolean - Whether we animate the rotation of the Doughnut
                                        animateRotate: true,

                                        //Boolean - Whether we animate scaling the Doughnut from the centre
                                        animateScale: false,

                                        //String - A legend template
                                        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

                                    };
                                    var ctx = document.getElementById("makro-chart").getContext("2d");
                                    var myPieChart = new Chart(ctx).Pie(data, options);

                                });

                            </script>
                        </div>

                    </div>

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">

        function voting(vote, id) {

            $.ajax({
                type: "POST",
                url: "/users/vote",
                data: {
                    Vote: {
                        recipe_id: id,
                        mark: vote
                    }
                },
                dataType: "json",
                error: function (response) {
                }

                ,
                success: function (response) {
                    var mark = response['vote'];
                    var recipe_id = response['id'];
                    var object = $('[data-id="' + recipe_id + '"]');
                    object.parent().fadeOut('fast', function () {
                        object.html("");
                        console.log(mark);
                        object.attr('data-rating', mark);
                        object.attr('data-vote', 'denied');

                        console.log(object);

                        var p = object.parent();

                        object.remove();
                        object = $('<div></div>').addClass('non-voted-stars');


                        for (var i = 0; i < 5; i++) {
                            console.log('for');
                            if (i < mark) {
                                console.log('i<mark');
                                object.append("<span class='glyphicon glyphicon-star'></span>");
                            } else {
                                console.log('else');
                                object.append("<span class='glyphicon glyphicon-star-empty'></span>");
                            }
                        }
                        $('#info-' + recipe_id).html("Ocena " + mark + "/5");

                        p.fadeIn('fast');

                        p.prepend(object);
                    });


                }
                ,
                done: function (response) {
                }
            })

        }
        $(document).ready(function () {
            $('.print-recipe').on('click', function (e) {
                e.preventDefault();
                var elements = [];
                elements[0] = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "/pages/pre_print_recipe",
                    data: {
                        Recipe: {
                            elements: elements
                        }
                    },
                    dataType: "json",
                    error: function (response) {
                    }

                    ,
                    success: function (response) {
                        if (response == 'done') {
                            var win = window.open(window.location.origin + '/pages/print_recipe', '_blank');
                            win.focus();

                        }

                    }

                })
            });
            $('.person').on('click', function () {

                $('.person').removeClass('active');

                $(this).addClass('active');

                var name = $(this).html();
                var recipe_id = $(this).parent().data('id');


                $.ajax({
                    type: "POST",
                    url: "/pages/change_ingredients",
                    data: {
                        name: name,
                        recipe_id: recipe_id
                    },
                    dataType: "html",
                    error: function (response) {
                        console.log(response);
                    },
                    success: function (response) {
                        $('.food-components-list').remove();
                        $('.food-components').append(response);
                    },
                    done: function (response) {
                        console.log(response);
                    }
                });


            });


            var $animation_elements = $('.simply-box');
            var $window = $(window);

            function check_if_in_view() {
                var window_height = $window.height();
                var window_top_position = $window.scrollTop();
                var window_bottom_position = (window_top_position + window_height);

                $.each($animation_elements, function () {
                    var $element = $(this);
                    var element_height = $element.outerHeight();
                    var element_top_position = $element.offset().top;
                    var element_bottom_position = (element_top_position + element_height);

                    //check to see if this current container is within viewport
                    if ((element_bottom_position >= window_top_position) &&
                        (element_top_position <= window_bottom_position)) {
                        $element.addClass('in-view');

                    }
                    /*
                     else{
                     //                        console.log("__");
                     //                        console.log($animation_elements);
                     //                        console.log(element_bottom_position);
                     //                        console.log(window_top_position);
                     //                        console.log(element_top_position);
                     //                        console.log(window_bottom_position);
                     //                        console.log("___");
                     $element.removeClass('in-view');
                     }
                     */
                });
            }

            $window.on('scroll resize', check_if_in_view);
            $window.trigger('scroll');
        })
        ;


        //------------------
        (function (e) {
            var t, o = {
                className: "autosizejs",
                append: "",
                callback: !1,
                resizeDelay: 10
            }, i = '<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>', n = ["fontFamily", "fontSize", "fontWeight", "fontStyle", "letterSpacing", "textTransform", "wordSpacing", "textIndent"], s = e(i).data("autosize", !0)[0];
            s.style.lineHeight = "99px", "99px" === e(s).css("lineHeight") && n.push("lineHeight"), s.style.lineHeight = "", e.fn.autosize = function (i) {
                return this.length ? (i = e.extend({}, o, i || {}), s.parentNode !== document.body && e(document.body).append(s), this.each(function () {
                    function o() {
                        var t, o;
                        "getComputedStyle" in window ? (t = window.getComputedStyle(u, null), o = u.getBoundingClientRect().width, e.each(["paddingLeft", "paddingRight", "borderLeftWidth", "borderRightWidth"], function (e, i) {
                            o -= parseInt(t[i], 10)
                        }), s.style.width = o + "px") : s.style.width = Math.max(p.width(), 0) + "px"
                    }

                    function a() {
                        var a = {};
                        if (t = u, s.className = i.className, d = parseInt(p.css("maxHeight"), 10), e.each(n, function (e, t) {
                                a[t] = p.css(t)
                            }), e(s).css(a), o(), window.chrome) {
                            var r = u.style.width;
                            u.style.width = "0px", u.offsetWidth, u.style.width = r
                        }
                    }

                    function r() {
                        var e, n;
                        t !== u ? a() : o(), s.value = u.value + i.append, s.style.overflowY = u.style.overflowY, n = parseInt(u.style.height, 10), s.scrollTop = 0, s.scrollTop = 9e4, e = s.scrollTop, d && e > d ? (u.style.overflowY = "scroll", e = d) : (u.style.overflowY = "hidden", c > e && (e = c)), e += w, n !== e && (u.style.height = e + "px", f && i.callback.call(u, u))
                    }

                    function l() {
                        clearTimeout(h), h = setTimeout(function () {
                            var e = p.width();
                            e !== g && (g = e, r())
                        }, parseInt(i.resizeDelay, 10))
                    }

                    var d, c, h, u = this, p = e(u), w = 0, f = e.isFunction(i.callback), z = {
                        height: u.style.height,
                        overflow: u.style.overflow,
                        overflowY: u.style.overflowY,
                        wordWrap: u.style.wordWrap,
                        resize: u.style.resize
                    }, g = p.width();
                    p.data("autosize") || (p.data("autosize", !0), ("border-box" === p.css("box-sizing") || "border-box" === p.css("-moz-box-sizing") || "border-box" === p.css("-webkit-box-sizing")) && (w = p.outerHeight() - p.height()), c = Math.max(parseInt(p.css("minHeight"), 10) - w || 0, p.height()), p.css({
                        overflow: "hidden",
                        overflowY: "hidden",
                        wordWrap: "break-word",
                        resize: "none" === p.css("resize") || "vertical" === p.css("resize") ? "none" : "horizontal"
                    }), "onpropertychange" in u ? "oninput" in u ? p.on("input.autosize keyup.autosize", r) : p.on("propertychange.autosize", function () {
                        "value" === event.propertyName && r()
                    }) : p.on("input.autosize", r), i.resizeDelay !== !1 && e(window).on("resize.autosize", l), p.on("autosize.resize", r), p.on("autosize.resizeIncludeStyle", function () {
                        t = null, r()
                    }), p.on("autosize.destroy", function () {
                        t = null, clearTimeout(h), e(window).off("resize", l), p.off("autosize").off(".autosize").css(z).removeData("autosize")
                    }), r())
                })) : this
            }
        })(window.jQuery || window.$);

        var __slice = [].slice;
        (function (e, t) {
            var n;
            n = function () {
                function t(t, n) {
                    var r, i, s, o = this;
                    this.options = e.extend({}, this.defaults, n);
                    this.$el = t;
                    s = this.defaults;
                    for (r in s) {
                        i = s[r];
                        if (this.$el.data(r) != null) {
                            this.options[r] = this.$el.data(r)
                        }
                    }
                    this.createStars();
                    this.syncRating();
                    console.log();
                    if (this.$el.data('vote') != 'denied') {
                        this.$el.addClass('active-stars');

                        this.$el.on("mouseover.starrr", "span", function (e) {
                            return o.syncRating(o.$el.find("span").index(e.currentTarget) + 1)
                        });
                        this.$el.on("mouseout.starrr", function () {
                            return o.syncRating()
                        });
                        this.$el.on("click.starrr", "span", function (e) {
                            voting(o.$el.find("span").index(e.currentTarget) + 1, e.delegateTarget.dataset.id);
                        });
                        this.$el.on("starrr:change", this.options.change)
                    }
                }

                t.prototype.defaults = {
                    rating: void 0, numStars: 5, change: function (e, t) {
                    }
                };
                t.prototype.createStars = function () {
                    var e, t, n;
                    n = [];
                    for (e = 1, t = this.options.numStars; 1 <= t ? e <= t : e >= t; 1 <= t ? e++ : e--) {
                        n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))
                    }
                    return n
                };
                t.prototype.setRating = function (e) {
                    if (this.options.rating === e) {
                        e = void 0
                    }
                    this.options.rating = e;
                    this.syncRating();
                    return this.$el.trigger("starrr:change", e)
                };
                t.prototype.syncRating = function (e) {
                    var t, n, r, i;
                    e || (e = this.options.rating);
                    if (e) {
                        for (t = n = 0, i = e - 1; 0 <= i ? n <= i : n >= i; t = 0 <= i ? ++n : --n) {
                            this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")
                        }
                    }
                    if (e && e < 5) {
                        for (t = r = e; e <= 4 ? r <= 4 : r >= 4; t = e <= 4 ? ++r : --r) {
                            this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")
                        }
                    }
                    if (!e) {
                        return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")
                    }
                };
                return t
            }();
            return e.fn.extend({
                starrr: function () {
                    var t, r;
                    r = arguments[0], t = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                    return this.each(function () {
                        var i;
                        i = e(this).data("star-rating");
                        if (!i) {
                            e(this).data("star-rating", i = new n(e(this), r))
                        }
                        if (typeof r === "string") {
                            return i[r].apply(i, t)
                        }
                    })
                }
            })
        })(window.jQuery, window);
        $(function () {
            return $(".starrr").starrr()
        })

        $(function () {

            $('#new-review').autosize({append: "\n"});

            var reviewBox = $('#post-review-box');
            var newReview = $('#new-review');
            var openReviewBtn = $('#open-review-box');
            var closeReviewBtn = $('#close-review-box');
            var ratingsField = $('#ratings-hidden');

            openReviewBtn.click(function (e) {
                reviewBox.slideDown(400, function () {
                    $('#new-review').trigger('autosize.resize');
                    newReview.focus();
                });
                openReviewBtn.fadeOut(100);
                closeReviewBtn.show();
            });

            closeReviewBtn.click(function (e) {
                e.preventDefault();
                reviewBox.slideUp(300, function () {
                    newReview.focus();
                    openReviewBtn.fadeIn(200);
                });
                closeReviewBtn.hide();

            });

            $('.starrr').on('starrr:change', function (e, value) {
                ratingsField.val(value);
            });
        });


    </script>

</section>