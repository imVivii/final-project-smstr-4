import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { PendaftaranBaruPageRoutingModule } from './pendaftaran-baru-routing.module';

import { PendaftaranBaruPage } from './pendaftaran-baru.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    PendaftaranBaruPageRoutingModule
  ],
  declarations: [PendaftaranBaruPage]
})
export class PendaftaranBaruPageModule {}
