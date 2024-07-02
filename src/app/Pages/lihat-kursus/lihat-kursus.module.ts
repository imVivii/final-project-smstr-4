import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LihatKursusPageRoutingModule } from './lihat-kursus-routing.module';

import { LihatKursusPage } from './lihat-kursus.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LihatKursusPageRoutingModule
  ],
  declarations: [LihatKursusPage]
})
export class LihatKursusPageModule {}
