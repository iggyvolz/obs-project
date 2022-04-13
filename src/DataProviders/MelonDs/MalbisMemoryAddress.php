<?php

namespace iggyvolz\ObsProject\DataProviders\MelonDs;

enum MalbisMemoryAddress: int
{
    #[DataTypeAttribute(DataType::Byte)]
    case ByeByeGloves = 0x22056451;

    #[DataTypeAttribute(DataType::Byte)]
    case SoftenerGloves = 0x22056452;

    #[DataTypeAttribute(DataType::Byte)]
    case ItemGloves = 0x22056453;

    #[DataTypeAttribute(DataType::Byte)]
    case SiphonGloves = 0x22056454;

    #[DataTypeAttribute(DataType::Byte)]
    case DentGloves = 0x22056455;

    #[DataTypeAttribute(DataType::Byte)]
    case PowBoots = 0x22056456;

    #[DataTypeAttribute(DataType::Byte)]
    case DxPowBoots = 0x22056457;

    #[DataTypeAttribute(DataType::Byte)]
    case TipTopBoots = 0x22056458;

    #[DataTypeAttribute(DataType::Byte)]
    case SpecialBoots = 0x22056459;

    #[DataTypeAttribute(DataType::Byte)]
    case HeavyBoots = 0x2205645a;

    #[DataTypeAttribute(DataType::Byte)]
    case DaredevilBoots = 0x2205645b;

    #[DataTypeAttribute(DataType::Byte)]
    case ShellBoots = 0x2205645c;

    #[DataTypeAttribute(DataType::Byte)]
    case DizzyBoots = 0x2205645d;

    #[DataTypeAttribute(DataType::Byte)]
    case ShroobBoots = 0x2205645e;

    #[DataTypeAttribute(DataType::Byte)]
    case CoinBoots = 0x2205645f;

    #[DataTypeAttribute(DataType::Byte)]
    case SiphonBoots = 0x22056460;

    #[DataTypeAttribute(DataType::Byte)]
    case BigStompBoots = 0x22056461;

    #[DataTypeAttribute(DataType::Byte)]
    case HappyCharm = 0x22056462;

    #[DataTypeAttribute(DataType::Byte)]
    case LuckCharm = 0x22056463;

    #[DataTypeAttribute(DataType::Byte)]
    case ThriftCharm = 0x22056464;

    #[DataTypeAttribute(DataType::Byte)]
    case BudgetCharm = 0x22056465;

    #[DataTypeAttribute(DataType::Byte)]
    case TightBelt = 0x22056466;

    #[DataTypeAttribute(DataType::Byte)]
    case AdvicePatch = 0x22056467;

    #[DataTypeAttribute(DataType::Byte)]
    case LuxuryPatch = 0x22056468;

    #[DataTypeAttribute(DataType::Byte)]
    case HeroicCharm = 0x22056469;

    #[DataTypeAttribute(DataType::Byte)]
    case SmallShell = 0x2205646a;

    #[DataTypeAttribute(DataType::Byte)]
    case BigShell = 0x2205646b;

    #[DataTypeAttribute(DataType::Byte)]
    case GiantShell = 0x2205646c;

    #[DataTypeAttribute(DataType::Byte)]
    case KoShell = 0x2205646d;

    #[DataTypeAttribute(DataType::Byte)]
    case GoldRing = 0x2205646e;

    #[DataTypeAttribute(DataType::Byte)]
    case GoldCrown = 0x2205646f;

    #[DataTypeAttribute(DataType::Byte)]
    case LazyScarf = 0x22056470;

    #[DataTypeAttribute(DataType::Byte)]
    case MushroomStone = 0x22056471;

    #[DataTypeAttribute(DataType::Byte)]
    case PowMushJam = 0x22056472;

    #[DataTypeAttribute(DataType::Byte)]
    case DefMushJam = 0x22056473;

    #[DataTypeAttribute(DataType::Byte)]
    case TreasureSpecs = 0x22056474;

    #[DataTypeAttribute(DataType::Byte)]
    case VengeanceCape = 0x22056475;

    #[DataTypeAttribute(DataType::Byte)]
    case ChallengeMedal = 0x22056476;

    #[DataTypeAttribute(DataType::Byte)]
    case ShabbyShell = 0x22056477;

    #[DataTypeAttribute(DataType::Byte)]
    case SpecialShell = 0x22056478;

    #[DataTypeAttribute(DataType::Byte)]
    case SafetyShell = 0x22056479;

    #[DataTypeAttribute(DataType::Byte)]
    case JudgeShell = 0x2205647a;

    #[DataTypeAttribute(DataType::Byte)]
    case RockShell = 0x2205647b;

    #[DataTypeAttribute(DataType::Byte)]
    case ArmoredShell = 0x2205647c;

    #[DataTypeAttribute(DataType::Byte)]
    case RampageShell = 0x2205647d;

    #[DataTypeAttribute(DataType::Byte)]
    case DreamShell = 0x2205647e;

    #[DataTypeAttribute(DataType::Byte)]
    case WickedShell = 0x2205647f;

    #[DataTypeAttribute(DataType::Byte)]
    case IroncladShell = 0x22056480;

    #[DataTypeAttribute(DataType::Byte)]
    case BlockRing = 0x22056481;

    #[DataTypeAttribute(DataType::Byte)]
    case KingShell = 0x22056482;

    #[DataTypeAttribute(DataType::Byte)]
    case PowerBand = 0x22056483;

    #[DataTypeAttribute(DataType::Byte)]
    case PowerBandPlus = 0x22056484;

    #[DataTypeAttribute(DataType::Byte)]
    case MinionBand = 0x22056485;

    #[DataTypeAttribute(DataType::Byte)]
    case MinionBandSp = 0x22056486;

    #[DataTypeAttribute(DataType::Byte)]
    case IronFistBand = 0x22056487;

    #[DataTypeAttribute(DataType::Byte)]
    case VampireBand = 0x22056488;

    #[DataTypeAttribute(DataType::Byte)]
    case StaminaBand = 0x22056489;

    #[DataTypeAttribute(DataType::Byte)]
    case HunterBand = 0x2205648a;

    #[DataTypeAttribute(DataType::Byte)]
    case LuckyBand = 0x2205648b;

    #[DataTypeAttribute(DataType::Byte)]
    case BlockBand = 0x2205648c;

    #[DataTypeAttribute(DataType::Byte)]
    case FuryBand = 0x2205648d;

    #[DataTypeAttribute(DataType::Byte)]
    case TenPercentPowerFangs = 0x2205648e;

    #[DataTypeAttribute(DataType::Byte)]
    case TwentyPercentPowerFangs = 0x2205648f;

    #[DataTypeAttribute(DataType::Byte)]
    case TwentyPercentSpecialFangs = 0x22056490;

    #[DataTypeAttribute(DataType::Byte)]
    case FortyPercentSpecialFangs = 0x22056491;

    #[DataTypeAttribute(DataType::Byte)]
    case RedHotFangs = 0x22056492;

    #[DataTypeAttribute(DataType::Byte)]
    case BurningFangs = 0x22056493;

    #[DataTypeAttribute(DataType::Byte)]
    case FuryFangs = 0x22056494;

    #[DataTypeAttribute(DataType::Byte)]
    case BoneFangs = 0x22056495;

    #[DataTypeAttribute(DataType::Byte)]
    case IntruderFangs = 0x22056496;

    #[DataTypeAttribute(DataType::Byte)]
    case BlockFangs = 0x22056497;

    #[DataTypeAttribute(DataType::Byte)]
    case FlashyFangs = 0x22056498;

    #[DataTypeAttribute(DataType::Byte)]
    case CheapRing = 0x22056499;

    #[DataTypeAttribute(DataType::Byte)]
    case EconomyRing = 0x2205649a;

    #[DataTypeAttribute(DataType::Byte)]
    case HeroicRing = 0x2205649b;

    #[DataTypeAttribute(DataType::Byte)]
    case GluttonRing = 0x2205649c;

    #[DataTypeAttribute(DataType::Byte)]
    case ExcellentRing = 0x2205649d;

    #[DataTypeAttribute(DataType::Byte)]
    case DrumstickRing = 0x2205649e;

    #[DataTypeAttribute(DataType::Byte)]
    case PeaceRing = 0x2205649f;

    #[DataTypeAttribute(DataType::Byte)]
    case FillUpRing = 0x220564a0;

    #[DataTypeAttribute(DataType::Byte)]
    case RestoreRing = 0x220564a1;

    #[DataTypeAttribute(DataType::Byte)]
    case FastCashRing = 0x220564a2;

    #[DataTypeAttribute(DataType::Byte)]
    case TreasureRing = 0x220564a3;

    #[DataTypeAttribute(DataType::Byte)]
    case SafetyRing = 0x220564a4;

    #[DataTypeAttribute(DataType::Byte)]
    case HardRing = 0x220564a5;

    #[DataTypeAttribute(DataType::Byte)]
    case RentalShell = 0x220564a6;

    #[DataTypeAttribute(DataType::Short)]
    case MarioMaxHp = 0x1205637e;

    #[DataTypeAttribute(DataType::Short)]
    case MarioHp = 0x12056380;

    #[DataTypeAttribute(DataType::Short)]
    case MarioMaxSp = 0x12056382;

    #[DataTypeAttribute(DataType::Short)]
    case MarioSp = 0x12056384;

    #[DataTypeAttribute(DataType::Short)]
    case MarioPow = 0x12056386;

    #[DataTypeAttribute(DataType::Short)]
    case MarioDef = 0x12056388;

    #[DataTypeAttribute(DataType::Short)]
    case MarioSpeed = 0x1205638a;

    #[DataTypeAttribute(DataType::Short)]
    case MarioStache = 0x1205638c;

    #[DataTypeAttribute(DataType::Short)]
    case LuigiMaxHp = 0x120563ae;

    #[DataTypeAttribute(DataType::Short)]
    case LuigiHp = 0x120563b0;

    #[DataTypeAttribute(DataType::Short)]
    case LuigiMaxSp = 0x120563b2;

    #[DataTypeAttribute(DataType::Short)]
    case LuigiSp = 0x120563b4;

    #[DataTypeAttribute(DataType::Short)]
    case LuigiPow = 0x120563b6;

    #[DataTypeAttribute(DataType::Short)]
    case LuigiDef = 0x120563b8;

    #[DataTypeAttribute(DataType::Short)]
    case LuigiSpeed = 0x120563ba;

    #[DataTypeAttribute(DataType::Short)]
    case LuigiStache = 0x120563bc;

    #[DataTypeAttribute(DataType::Short)]
    case BowserMaxHp = 0x120563de;

    #[DataTypeAttribute(DataType::Short)]
    case BowserHp = 0x120563e0;

    #[DataTypeAttribute(DataType::Short)]
    case BowserMaxSp = 0x120563e2;

    #[DataTypeAttribute(DataType::Short)]
    case BowserSp = 0x120563e4;

    #[DataTypeAttribute(DataType::Short)]
    case BowserPow = 0x120563e6;

    #[DataTypeAttribute(DataType::Short)]
    case BowserDef = 0x120563e8;

    #[DataTypeAttribute(DataType::Short)]
    case BowserSpeed = 0x120563ea;

    #[DataTypeAttribute(DataType::Short)]
    case BowserHorn = 0x120563ec;

    #[DataTypeAttribute(DataType::Byte)]
    case Mushrooms = 0x22056406;

    #[DataTypeAttribute(DataType::Byte)]
    case SuperMushrooms = 0x22056407;

    #[DataTypeAttribute(DataType::Byte)]
    case UltraMushrooms = 0x22056408;

    #[DataTypeAttribute(DataType::Byte)]
    case MaxMushrooms = 0x22056409;

    #[DataTypeAttribute(DataType::Byte)]
    case HotDrumsticks = 0x2205640a;

    #[DataTypeAttribute(DataType::Byte)]
    case FieryDrumsticks = 0x2205640b;

    #[DataTypeAttribute(DataType::Byte)]
    case TntDrumsticks = 0x2205640c;

    #[DataTypeAttribute(DataType::Byte)]
    case Nuts = 0x2205640d;

    #[DataTypeAttribute(DataType::Byte)]
    case SuperNuts = 0x2205640e;

    #[DataTypeAttribute(DataType::Byte)]
    case UltraNuts = 0x2205640f;

    #[DataTypeAttribute(DataType::Byte)]
    case MaxNuts = 0x22056410;

    #[DataTypeAttribute(DataType::Byte)]
    case SyrupJars = 0x22056411;

    #[DataTypeAttribute(DataType::Byte)]
    case SupersyrupJars = 0x22056412;

    #[DataTypeAttribute(DataType::Byte)]
    case UltrasyrupJars = 0x22056413;

    #[DataTypeAttribute(DataType::Byte)]
    case MaxSyrupJars = 0x22056414;

    #[DataTypeAttribute(DataType::Byte)]
    case StarCandies = 0x22056415;

    #[DataTypeAttribute(DataType::Byte)]
    case OneUpMushrooms = 0x22056416;

    #[DataTypeAttribute(DataType::Byte)]
    case OneUpDeluxes = 0x22056417;

    #[DataTypeAttribute(DataType::Byte)]
    case RefreshingHerbs = 0x22056418;

    #[DataTypeAttribute(DataType::Byte)]
    case HeartBeans = 0x2205641a;

    #[DataTypeAttribute(DataType::Byte)]
    case SpecialBeans = 0x2205641b;

    #[DataTypeAttribute(DataType::Byte)]
    case PowerBeans = 0x2205641c;

    #[DataTypeAttribute(DataType::Byte)]
    case RetryClocks = 0x2205641d;

    #[DataTypeAttribute(DataType::Byte)]
    case ThinWear = 0x2056427;

    #[DataTypeAttribute(DataType::Byte)]
    case PicnicWear = 0x2056428;

    #[DataTypeAttribute(DataType::Byte)]
    case LeisurePants = 0x22056429;

    #[DataTypeAttribute(DataType::Byte)]
    case FighterWear = 0x2205642a;

    #[DataTypeAttribute(DataType::Byte)]
    case HeartWear = 0x2205642b;

    #[DataTypeAttribute(DataType::Byte)]
    case BrawnyWear = 0x2205642c;

    #[DataTypeAttribute(DataType::Byte)]
    case GrownUpWear = 0x2205642d;

    #[DataTypeAttribute(DataType::Byte)]
    case KoopaWear = 0x2205642e;

    #[DataTypeAttribute(DataType::Byte)]
    case HeroWear = 0x2205642f;

    #[DataTypeAttribute(DataType::Byte)]
    case BalmWear = 0x22056430;

    #[DataTypeAttribute(DataType::Byte)]
    case MuscleWear = 0x22056431;

    #[DataTypeAttribute(DataType::Byte)]
    case MasterWear = 0x22056432;

    #[DataTypeAttribute(DataType::Byte)]
    case KingWear = 0x22056433;

    #[DataTypeAttribute(DataType::Byte)]
    case StarWear = 0x22056434;

    #[DataTypeAttribute(DataType::Byte)]
    case DStarWear = 0x22056435;

    #[DataTypeAttribute(DataType::Byte)]
    case AOkWear = 0x22056436;

    #[DataTypeAttribute(DataType::Byte)]
    case RentalWear = 0x22056437;

    #[DataTypeAttribute(DataType::Byte)]
    case HpSocks = 0x22056438;

    #[DataTypeAttribute(DataType::Byte)]
    case DeluxeHpSocks = 0x22056439;

    #[DataTypeAttribute(DataType::Byte)]
    case SpSocks = 0x2205643a;

    #[DataTypeAttribute(DataType::Byte)]
    case DxSpSocks = 0x2205643b;

    #[DataTypeAttribute(DataType::Byte)]
    case HustleSocks = 0x2205643c;

    #[DataTypeAttribute(DataType::Byte)]
    case CoinSocks = 0x2205643d;

    #[DataTypeAttribute(DataType::Byte)]
    case StarchedSocks = 0x2205643e;

    #[DataTypeAttribute(DataType::Byte)]
    case GumptionSocks = 0x2205643f;

    #[DataTypeAttribute(DataType::Byte)]
    case BroSocks = 0x22056440;

    #[DataTypeAttribute(DataType::Byte)]
    case GallSocks = 0x22056441;

    #[DataTypeAttribute(DataType::Byte)]
    case RuggedSocks = 0x22056442;

    #[DataTypeAttribute(DataType::Byte)]
    case ExpSocks = 0x22056443;

    #[DataTypeAttribute(DataType::Byte)]
    case NoTouchSocks = 0x22056444;

    #[DataTypeAttribute(DataType::Byte)]
    case NurseSocks = 0x22056445;

    #[DataTypeAttribute(DataType::Byte)]
    case DoctorSocks = 0x22056446;

    #[DataTypeAttribute(DataType::Byte)]
    case SpecialSocks = 0x22056447;

    #[DataTypeAttribute(DataType::Byte)]
    case SurprisingSocks = 0x22056448;

    #[DataTypeAttribute(DataType::Byte)]
    case GuardianSocks = 0x22056449;

    #[DataTypeAttribute(DataType::Byte)]
    case PowGloves = 0x2205644a;

    #[DataTypeAttribute(DataType::Byte)]
    case DxPowGloves = 0x2205644b;

    #[DataTypeAttribute(DataType::Byte)]
    case MushroomGloves = 0x2205644c;

    #[DataTypeAttribute(DataType::Byte)]
    case SpecialGloves = 0x2205644d;

    #[DataTypeAttribute(DataType::Byte)]
    case HeavyGloves = 0x2205644e;

    #[DataTypeAttribute(DataType::Byte)]
    case DeliciousGloves = 0x2205644f;

    #[DataTypeAttribute(DataType::Byte)]
    case FlowerGloves = 0x22056450;

    #[DataTypeAttribute(DataType::Short)]
    case Coins = 0x20f8e28;

    #[DataTypeAttribute(DataType::Int3)]
    case MarioExp = 0x2056390;

    #[DataTypeAttribute(DataType::Int3)]
    case LuigiExp = 0x20563c0;

    #[DataTypeAttribute(DataType::Int3)]
    case BowserExp = 0x20563f0;

    #[DataTypeAttribute(DataType::Short)]
    case MarioHpInBattle = 0x12127906;

    public function get(MelonDsApi $melonDs): int|bool
    {
        /** @var DataTypeAttribute $dta */
        $dta = (new \ReflectionEnumUnitCase(self::class, $this->name))->getAttributes(DataTypeAttribute::class)[0]->newInstance();
        return $dta->dataType->get($this->value, $melonDs);
    }
}