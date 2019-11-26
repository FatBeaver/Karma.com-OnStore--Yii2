<ul class="pagination">

<?php if ($this->currentPage != 1): ?>    
    <li class="prev-arrow">
        <a href="/<?= $this->firstURIindex ?>/page/<?=$this->currentPage - 1?>" data-page="<?=$this->currentPage - 1?>" aria-label="Previous">
            <span aria-hidden="true">
                <span class="lnr lnr-chevron-left" style="color:#444;"></span>
            </span>
        </a>
    </li>
<?php endif; ?>   

<?php if (($this->currentPage == $this->countPage) && ($this->countPage > 2)): ?>   
    <li class="page-item "><a href="/<?=$this->firstURIindex?><?=$this->secondURIindex?>/page/<?=$this->currentPage - 2?>" 
        data-page="<?=$this->currentPage - 2?>" style="color:#444;">
    <?=$this->currentPage - 2?></a></li>
<?php endif; ?> 
<?php if ($this->currentPage - 1 > 0): ?>   
    <li class="page-item "><a href="/<?=$this->firstURIindex?><?=$this->secondURIindex?>/page/<?=$this->currentPage - 1?>" 
        data-page="<?=$this->currentPage - 1?>" style="color:#444;">
    <?= $this->currentPage - 1 ?></a></li>
<?php endif; ?>   


<li class="page-item active"><a href="/<?=$this->firstURIindex?><?=$this->secondURIindex?>/page/<?= $this->currentPage ?>" 
    data-page="<?=$this->currentPage?>" style="color:#444;">
<?= $this->currentPage; ?></a></li>
 

<?php if ($this->currentPage + 1 < $this->countPage + 1): ?>   
    <li class="page-item"><a href="/<?=$this->firstURIindex?><?=$this->secondURIindex?>/page/<?= $this->currentPage + 1?>" 
        data-page="<?=$this->currentPage + 1?>" style="color:#444;">
    <?= $this->currentPage + 1 ?></a></li>
<?php endif; ?>  
<?php if (($this->currentPage == 1) && ($this->countPage > 2)): ?>    
<li class="page-item"><a href="/<?=$this->firstURIindex?><?=$this->secondURIindex?>/page/<?= $this->currentPage + 2?>" 
        data-page="<?=$this->currentPage + 2?>" style="color:#444;">
    <?= $this->currentPage + 2 ?></a></li>
<?php endif; ?>  


<?php if ($this->currentPage != $this->countPage): ?>   
    <li class="next-arrow">
        <a href="/<?= $this->firstURIindex ?>/page/<?=$this->currentPage + 1?>" data-page="<?=$this->currentPage + 1?>" 
            aria-label="Next">
            <span aria-hidden="true">
                <span class="lnr lnr-chevron-right" style="color:#444;"></span>
            </span>
        </a>
    </li>
<?php endif; ?> 

</ul>