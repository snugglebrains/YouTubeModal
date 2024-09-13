<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Modal YouTube Example</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/dialog-polyfill@0.5.6/dist/dialog-polyfill.min.css" />
</head>
<body>

    <!-- Video Modal Section -->
    <?php
    // Include the modals by including 'dc-video-modal-youtube.php' multiple times
    // Set up an array of video data
    $videos = [
        [
            'thumbnail' => 'thumbnail1.png',
            'video_id' => 'wDchsz8nmbo?si=44B-z24h5YVajBLg',
            'caption' => 'Caption for Video 1',
        ],
        [
            'thumbnail' => 'thumbnail1.png',
            'video_id' => 'XALBGkjkUPQ?si=xvy3JXbaj81VV9z_',
            'caption' => 'Caption for Video 2',
        ],
        [
            'thumbnail' => 'thumbnail1.png',
            'video_id' => 'GddV0N8aOeI?si=zcMLyGJFF6M_ivjk',
            'caption' => 'Caption for Video 3',
        ],
    ];

    foreach ($videos as $video) {
        // Set up the variables expected by 'dc-video-modal-youtube.php'
        $block = []; // In case 'dc-video-modal-youtube.php' uses $block
        $thumbnail = $video['thumbnail'];
        $videoID = $video['video_id'];
        $caption = $video['caption'];
        $autoplay = 0; // Set default autoplay to 0
        $controls = 1; // Set default controls to 1

        // Generate a unique ID for each video
        $unique_id = 'dc-video-' . uniqid();

        // Include the modal template
        include 'dc-video-modal-youtube.php';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/dialog-polyfill@0.5.6/dist/dialog-polyfill.min.js"></script>
    <script>
        document.querySelectorAll('dialog').forEach(function(modal) {
            dialogPolyfill.registerDialog(modal);
        });
    </script>

    <script src="video-modal-youtube.js"></script>
</body>
</html>
