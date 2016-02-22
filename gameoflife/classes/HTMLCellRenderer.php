<?php

class HTMLCellRenderer implements CellRenderer {
    private $width = "50px";
    private $height = "50px";
    public function renderLiveCell() {
        ob_start(); ?>
            <div style="min-width:<?php echo $this->width;?>; min-height:<?php echo $this->height;?>; max-width:<?php echo $this->width;?>; max-height:<?php echo $this->height;?>;">
                <img src="images/life1.gif" alt="LIFE" width="<?php echo $this->width;?>" height="<?php echo $this->height;?>">
            </div>
        <?php echo ob_get_clean();
    }
    public function renderDeadCell() {
        ob_start(); ?>
            <div style="display:block; min-width:<?php echo $this->width;?>; min-height:<?php echo $this->height;?>; max-width:<?php echo $this->width;?>; max-height:<?php echo $this->height;?>;">
                <img src="images/still1.jpg" alt="EMPTY" width="<?php echo $this->width;?>" height="<?php echo $this->height;?>">
            </div>
        <?php echo ob_get_clean();
    }
}
