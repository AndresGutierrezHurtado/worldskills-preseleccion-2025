document.addEventListener("DOMContentLoaded", () => {
    // MODALES Y VIDEOS
    const $cards = document.querySelectorAll(".popular__card");
    const $modal = document.querySelector(".modal");
    const $modalVideo = document.querySelector(".modal__video");
    const $closeModal = document.querySelector("#close-modal");
    const $playBtn = document.querySelector("#play-btn");

    $playBtn.addEventListener("click", (e) => {
        if ($modalVideo.paused) {
            $modalVideo.play();
        } else {
            $modalVideo.pause();
        }
    });

    $closeModal.addEventListener("click", (e) => {
        $modal.classList.add("hidden");
        $modalVideo.pause();
    });

    $cards.forEach(($card, idx) => {
        $card.addEventListener("click", (e) => {
            $modal.classList.remove("hidden");
            $modalVideo.src = `./assets/images/trailer${idx + 1}.mp4`;
            $modalVideo.play();
        });
    });

    // HERO BANNER
    const $heroImage = document.querySelector(".hero img");
    let index = 0;
    let segundos = 0;

    setInterval(() => {
        index++;

        const idxx = (index % 3) + 1;
        $heroImage.src = `./assets/images/banner${idxx}.jpg`;
    }, 5000);

    setInterval(() => {
        console.log(`Segundo ${segundos + 1} transcurrido`);
        segundos++;
    }, 1000);
});
