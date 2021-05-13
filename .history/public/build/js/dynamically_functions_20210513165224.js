window.onload = () => {
    const stars = document.querySelectorAll(".la-star");
    const score = document.querySelector("#score_score");

    for(star of stars){
        star.addEventListener("mouseover", function(){
            resetStars();
            this.style.color = "red";
            this.classList.add("las");
            this.classList.remove("lar");

            let previousStar = this.previousElementSibling;

            while(previousStar){
                previousStar.style.color = "red";
                previousStar.classList.add("las");
                previousStar.classList.remove("lar");
                previousStar = previousStar.previousElementSibling;
            }
        });

        star.addEventListener("click", function(){
            score.value = this.dataset.value;
        });

        star.addEventListener("mouseout", function(){
            resetStars(score.value);
        });
    }

    function resetStars(score = 0){
        for(star of stars){
            if(star.dataset.value > score){
                star.style.color = "black";
                star.classList.add("lar");
                star.classList.remove("las");
            }else{
                star.style.color = "red";
                star.classList.add("las");
                star.classList.remove("lar");
            }
        }
    }
}