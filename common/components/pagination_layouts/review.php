<?php if ($this->currentPage != 1): ?>    
    <p style="margin:3px 5px; !important">
        <a href="/<?=$this->firstURIindex?>/<?=$this->secondURIindex?>/page/<?=$this->currentPage - 1?>"
        style="color:#999;" class="review-pagination-button" data-page="<?=$this->currentPage - 1?>">
        <i class="lnr lnr-chevron-left"></i>
        Предыдущие 
        </a>
    </p>
<?php endif; ?>  

<?php if ($this->currentPage != $this->countPage): ?>   
    <p style="margin:3px 5px; !important">
        <a href="/<?=$this->firstURIindex?>/<?=$this->secondURIindex?>/page/<?=$this->currentPage + 1?>"
        style="color:#999;" class="review-pagination-button" data-page="<?=$this->currentPage + 1?>">
        Следующие <i class="lnr lnr-chevron-right"></i>
        </a>
    </p>
<?php endif; ?> 
