/*!
 * Custom Image Uploader
 */

(function($) {

    $.fn.imageUploader = function(options) {

        let defaults = {

            preloaded: [],

            imagesInputName: "gallery_images",

            preloadedInputName: "old",

            label: "Drag & Drop images here or click Browse Images",

            uploadUrl: "/admin/upload-image",

            deleteUrl: "/admin/delete-image",

            id: 0

        };


        let plugin = this;

        plugin.settings = {};


        /*
        Global DataTransfer object
        */
        let dataTransfer = new DataTransfer();


        /*
        Initialise plugin
        */
        plugin.init = function() {

            plugin.settings = $.extend({},
                defaults,
                options
            );


            plugin.each(function(i, wrapper) {

                let $container = createContainer();

                $(wrapper).empty();

                $(wrapper).append($container);


                /*
                Drag events
                */
                $container.on(
                    "dragover",
                    fileDragHover.bind($container)
                );

                $container.on(
                    "dragleave",
                    fileDragHover.bind($container)
                );

                $container.on(
                    "drop",
                    fileSelectHandler.bind($container)
                );


                /*
                Load existing images
                */
                if (
                    plugin.settings.preloaded &&
                    plugin.settings.preloaded.length
                ) {

                    $container.addClass("has-files");

                    let $uploadedContainer =
                        $container.find(".uploaded");


                    for (
                        let i = 0; i < plugin.settings.preloaded.length; i++
                    ) {

                        $uploadedContainer.append(

                            createImg(
                                plugin.settings.preloaded[i].src,
                                plugin.settings.preloaded[i].id,
                                1
                            )

                        );

                    }

                }

            });

        };


        /*
        Create uploader container
        */
        let createContainer = function() {

            let $container = $("<div>", {

                class: "image-uploader"

            });


            /*
            Actual file input
            */
            let $input = $("<input>", {

                type: "file",

                id: plugin.settings.imagesInputName +
                    "-" +
                    random(),

                name: plugin.settings.imagesInputName +
                    "[]",

                multiple: true,

                accept: "image/*"

            }).appendTo($container);


            /*
            Uploaded images container
            */
            let $uploadedContainer = $("<div>", {

                class: "uploaded"

            }).appendTo($container);


            /*
            Upload text
            */
            let $textContainer = $("<div>", {

                class: "upload-text"

            }).appendTo($container);


            /*
            Upload icon
            */
            $("<i>", {

                class: "fa fa-cloud-upload"

            }).appendTo($textContainer);


            /*
            Text
            */
            $("<span>", {

                text: plugin.settings.label

            }).appendTo($textContainer);


            /*
            Browse button
            */
            let $browseButton = $("<button>", {

                type: "button",

                class: "btn btn-primary",

                text: "Browse Images"

            }).appendTo($textContainer);


            /*
            Click uploader
            */
            $container.on("click", function(e) {

                if (
                    $(e.target).is("button") ||
                    $(e.target).closest("button").length
                ) {

                    return;

                }

                prevent(e);

                $input.trigger("click");

            });


            /*
            Browse button click
            */
            $browseButton.on("click", function(e) {

                prevent(e);

                $input.trigger("click");

            });


            /*
            Prevent input click bubbling
            */
            $input.on("click", function(e) {

                e.stopPropagation();

            });


            /*
            File selection
            */
            $input.on(
                "change",
                fileSelectHandler.bind($container)
            );


            return $container;

        };


        /*
        Prevent default
        */
        let prevent = function(e) {

            e.preventDefault();

            e.stopPropagation();

        };


        /*
        Check if uploader is empty
        */
        let checkEmptyUploader = function($uploader) {

            if (
                $uploader.find(".uploaded-image").length === 0
            ) {

                $uploader.removeClass("has-files");

            }

        };


        /*
        Create image preview
        */
        let createImg = function(
            src,
            id,
            type = ''
        ) {

            let $container = $("<div>", {

                class: "uploaded-image"

            });


            /*
            Image
            */
            let $img = $("<img>", {

                src: src

            }).appendTo($container);


            /*
            Progress bar
            */
            let $progressBar = $("<div>", {

                    class: "progress-bar"

                })
                .appendTo($container)
                .hide();


            /*
            Existing image
            */
            if (
                plugin.settings.preloaded.length &&
                type == 1
            ) {

                let $button = $("<button>", {

                    type: "button",

                    class: "delete-image"

                }).appendTo($container);


                $("<i>", {

                    class: "fa fa-trash"

                }).appendTo($button);


                $container.attr(
                    "data-preloaded",
                    true
                );


                let $preloaded = $("<input>", {

                    type: "hidden",

                    name: plugin.settings.preloadedInputName +
                        "[]",

                    value: id

                });


                $preloaded.attr(
                    "data-delete_url",
                    plugin.settings.deleteUrl
                );


                $preloaded.attr(
                    "data-type",
                    type
                );


                $preloaded.appendTo($container);


                /*
                Existing image delete
                */
                $button.on("click", function(e) {

                    prevent(e);


                    let $uploader =
                        $container.closest(
                            ".image-uploader"
                        );


                    let deleteUrl =
                        $container
                        .find("input")
                        .data("delete_url");


                    let imageId =
                        $container
                        .find("input")
                        .val();


                    deleteImage(
                        deleteUrl,
                        imageId,
                        $container,
                        $uploader
                    );

                });


            } else {

                /*
                New uploaded image
                */
                $container.attr(
                    "data-index",
                    id
                );


                let $hiddenInput = $("<input>", {

                    type: "hidden",

                    name: "new[]"

                });


                $hiddenInput.attr(
                    "data-delete_url",
                    plugin.settings.deleteUrl
                );


                $hiddenInput.attr(
                    "data-type",
                    type
                );


                $hiddenInput.appendTo($container);

            }


            /*
            Prevent click bubbling
            */
            $container.on("click", function(e) {

                prevent(e);

            });


            return $container;

        };


        /*
        Delete image
        */
        let deleteImage = function(
            deleteUrl,
            imageId,
            $container,
            $uploader
        ) {

            $.ajax({

                url: deleteUrl,

                type: "POST",

                data: {

                    id: imageId,

                    _token: $('meta[name="csrf-token"]').attr(
                        "content"
                    )

                },

                success: function(response) {

                    if (response.success) {

                        toastr.remove();

                        toastr.success(
                            "Image deleted successfully",
                            "Deleted"
                        );


                        $container.remove();


                        checkEmptyUploader(
                            $uploader
                        );

                    } else {

                        toastr.remove();

                        toastr.error(
                            response.message ||
                            "Failed to delete image",
                            "Error"
                        );

                    }

                },

                error: function(xhr) {

                    toastr.remove();

                    let message =
                        "Error occurred while deleting image";


                    if (
                        xhr.responseJSON &&
                        xhr.responseJSON.message
                    ) {

                        message =
                            xhr.responseJSON.message;

                    }


                    toastr.error(
                        message,
                        "Error"
                    );

                }

            });

        };


        /*
        Drag and drop
        */
        let fileDragHover = function(e) {

            prevent(e);


            if (e.type === "dragover") {

                $(this).addClass(
                    "drag-over"
                );

            } else {

                $(this).removeClass(
                    "drag-over"
                );

            }

        };


        /*
        File selection
        */
        let fileSelectHandler = function(e) {

            prevent(e);


            let $container = $(this);


            $container.removeClass(
                "drag-over"
            );


            let files;


            if (
                e.target &&
                e.target.files
            ) {

                files = e.target.files;

            } else if (
                e.originalEvent &&
                e.originalEvent.dataTransfer
            ) {

                files =
                    e.originalEvent
                    .dataTransfer
                    .files;

            }


            if (!files || !files.length) {

                return;

            }


            setPreview(
                $container,
                files
            );

        };


        /*
        Preview images
        */
        let setPreview = function(
            $container,
            files
        ) {

            $container.addClass(
                "has-files"
            );


            let $uploadedContainer =
                $container.find(
                    ".uploaded"
                );


            let $input =
                $container.find(
                    'input[type="file"]'
                );


            $(files).each(
                function(i, file) {

                    /*
                    Only images
                    */
                    if (!file.type.match(
                            /^image\//
                        )) {

                        toastr.error(
                            "Only image files are allowed.",
                            "Invalid File"
                        );

                        return;

                    }


                    /*
                    Add file to DataTransfer
                    */
                    dataTransfer.items.add(
                        file
                    );


                    let index =
                        dataTransfer.items.length - 1;


                    /*
                    Create preview
                    */
                    let $newImage =
                        createImg(
                            URL.createObjectURL(file),
                            index,
                            0
                        );


                    /*
                    Show progress
                    */
                    $newImage
                        .find(".progress-bar")
                        .show();


                    $uploadedContainer.append(
                        $newImage
                    );


                    /*
                    Upload image
                    */
                    uploadImage(
                        file,
                        $newImage.find(
                            ".progress-bar"
                        ),
                        $newImage
                    );

                }
            );


            /*
            Update input files
            */
            try {

                $input.prop(
                    "files",
                    dataTransfer.files
                );

            } catch (error) {

                console.log(
                    "Could not update file input",
                    error
                );

            }

        };


        /*
        Upload image
        */
        let uploadImage = function(
            file,
            $progressBar,
            $uploadedImageContainer
        ) {

            let formData =
                new FormData();


            formData.append(
                "id",
                plugin.settings.id
            );


            formData.append(
                "file",
                file
            );


            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr(
                    "content"
                )
            );


            /*
            Blur image during upload
            */
            $uploadedImageContainer
                .find("img")
                .css(
                    "filter",
                    "blur(4px)"
                );


            $.ajax({

                url: plugin.settings.uploadUrl,

                type: "POST",

                data: formData,

                processData: false,

                contentType: false,


                /*
                Upload progress
                */
                xhr: function() {

                    let xhr =
                        new XMLHttpRequest();


                    xhr.upload.addEventListener(
                        "progress",
                        function(e) {

                            if (
                                e.lengthComputable
                            ) {

                                let percent =
                                    (
                                        e.loaded /
                                        e.total
                                    ) *
                                    100;


                                $progressBar.css(
                                    "width",
                                    percent + "%"
                                );

                            }

                        },
                        false
                    );


                    return xhr;

                },


                /*
                Success
                */
                success: function(data) {

                    toastr.remove();

                    toastr.success(
                        "Image uploaded successfully!",
                        "Uploaded"
                    );


                    $progressBar.css(
                        "width",
                        "100%"
                    );


                    $progressBar.css(
                        "background-color",
                        "#28a745"
                    );


                    $uploadedImageContainer
                        .find("img")
                        .css(
                            "filter",
                            ""
                        );


                    /*
                    Image ID returned by backend
                    */
                    let imageId =
                        data.image_id;


                    /*
                    Store image ID
                    */
                    $uploadedImageContainer
                        .find(
                            'input[type="hidden"]'
                        )
                        .val(
                            imageId
                        );


                    /*
                    Add delete button
                    */
                    let $button =
                        $("<button>", {

                            type: "button",

                            class: "delete-image"

                        })
                        .appendTo(
                            $uploadedImageContainer
                        );


                    $("<i>", {

                        class: "fa fa-trash"

                    }).appendTo(
                        $button
                    );


                    /*
                    Delete newly uploaded image
                    */
                    $button.on(
                        "click",
                        function(e) {

                            prevent(e);


                            let $container =
                                $(this)
                                .closest(
                                    ".uploaded-image"
                                );


                            let $uploader =
                                $container
                                .closest(
                                    ".image-uploader"
                                );


                            let imageId =
                                $container
                                .find(
                                    'input[type="hidden"]'
                                )
                                .val();


                            deleteImage(

                                plugin.settings.deleteUrl,

                                imageId,

                                $container,

                                $uploader

                            );

                        }
                    );

                },


                /*
                Upload error
                */
                error: function(
                    xhr,
                    status,
                    error
                ) {

                    toastr.remove();


                    if (
                        xhr.responseJSON &&
                        xhr.responseJSON.errors
                    ) {

                        let errorMessages = "";


                        $.each(
                            xhr.responseJSON.errors,
                            function(
                                key,
                                value
                            ) {

                                if (
                                    Array.isArray(
                                        value
                                    )
                                ) {

                                    errorMessages +=
                                        value.join(
                                            "<br>"
                                        ) +
                                        "<br>";

                                } else {

                                    errorMessages +=
                                        value +
                                        "<br>";

                                }

                            }
                        );


                        toastr.error(
                            errorMessages,
                            "Validation Error"
                        );

                    } else {

                        toastr.error(
                            "Failed to upload image",
                            "Error"
                        );

                    }


                    /*
                    Mark progress as failed
                    */
                    $progressBar.css(
                        "background-color",
                        "#dc3545"
                    );


                    /*
                    Remove failed image after click
                    */
                    let $button =
                        $("<button>", {

                            type: "button",

                            class: "delete-image"

                        })
                        .appendTo(
                            $uploadedImageContainer
                        );


                    $("<i>", {

                        class: "fa fa-trash"

                    }).appendTo(
                        $button
                    );


                    $button.on(
                        "click",
                        function(e) {

                            prevent(e);


                            let $container =
                                $(this)
                                .closest(
                                    ".uploaded-image"
                                );


                            let $uploader =
                                $container
                                .closest(
                                    ".image-uploader"
                                );


                            $container.remove();


                            checkEmptyUploader(
                                $uploader
                            );

                        }
                    );

                }

            });

        };


        /*
        Random ID
        */
        let random = function() {

            return (
                Date.now() +
                Math.floor(
                    Math.random() *
                    100 +
                    1
                )
            );

        };


        /*
        Start plugin
        */
        this.init();


        return this;

    };

})(jQuery);
