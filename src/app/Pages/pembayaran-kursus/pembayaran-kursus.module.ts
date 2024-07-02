import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { PembayaranKursusPageRoutingModule } from './pembayaran-kursus-routing.module';

import { PembayaranKursusPage } from './pembayaran-kursus.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    PembayaranKursusPageRoutingModule
  ],
  declarations: [PembayaranKursusPage]
})
export class PembayaranKursusPageModule {}
