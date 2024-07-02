import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { PenilaianPageRoutingModule } from './penilaian-routing.module';

import { PenilaianPage } from './penilaian.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    PenilaianPageRoutingModule
  ],
  declarations: [PenilaianPage]
})
export class PenilaianPageModule {}
