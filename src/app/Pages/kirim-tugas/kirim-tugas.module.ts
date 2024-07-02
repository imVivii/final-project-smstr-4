import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { KirimTugasPageRoutingModule } from './kirim-tugas-routing.module';

import { KirimTugasPage } from './kirim-tugas.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    KirimTugasPageRoutingModule
  ],
  declarations: [KirimTugasPage]
})
export class KirimTugasPageModule {}
